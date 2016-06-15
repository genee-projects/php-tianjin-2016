<?php

require "Hardware.php";

$hardware = new Hardware('/dev/ttyO1');
$server = new swoole_websocket_server("0.0.0.0", 9501);

$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "有人连接 (fd=$request->fd)\n";
});

$server->on('message', function (swoole_websocket_server $server, $frame) 
    use ($hardware) {
        $d = (object) @json_decode($frame->data, true);
        echo "收到 $d->command\n";
        if ($d->command == 'open') {
            echo "尝试开门!\n";
            $hardware->open();
        } elseif ($d->command == 'card') {
            $message = json_encode([
                'event' => 'card',
                'data' => [
                    'card_no' => '123456'
                ]
            ]);
            foreach($server->connections as $fd) {
                $server->push($fd, $message);
            }
        }
});

$server->on('start', function (swoole_websocket_server $server) use ($hardware) {
    echo "WebSocket服务器开启\n";

    $hardware->on('card', function($cardNumber) use ($server) {
        printf ("获取到卡号 %s, 发送给所有人\n", $cardNumber);
        $message = json_encode([
            'event' => 'card',
            'data' => [
                'card_no' => $cardNumber
            ]
        ]);
        foreach($server->connections as $fd) {
            $server->push($fd, $message);
        }
    });

    $hardware->start();
});

$server->start();
