<?php

require "Hardware.php";

$hardware = new Hardware('/dev/ttyO1');
$server = new swoole_websocket_server("0.0.0.0", 9501);

$server->on('open', function (swoole_websocket_server $server, $request) {
    printf("%s: 连接WebSocket (fd=%s)\n", $request->server['remote_addr'], $request->fd);
});

$server->on('message', function (swoole_websocket_server $server, $frame) 
    use ($hardware) {
        $d = (object) @json_decode($frame->data, true);
        if ($d->command == 'open') {
            echo "[WebSocket] 尝试开门...\n";
            $hardware->open();
        } elseif ($d->command == 'card') {
            echo "[WebSocket] 模拟刷卡...\n";
            $hardware->emit('card', '123456');
        }
});

$server->on('start', function (swoole_websocket_server $server) use ($hardware) {
    echo "[WebSocket] 服务器开启\n";

    $hardware->on('card', function($cardNumber) use ($server) {
        printf ("[Hardware] 获取到卡号 (%s), 通知 WebSocket\n", $cardNumber);
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
