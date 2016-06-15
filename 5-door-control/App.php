<?php

function processWebSocket(swoole_process $worker) {
    $worker->exec('/usr/bin/env', ['php', __DIR__.'/WebSocket.php']);
}

function processHTTP(swoole_process $worker) {
    $worker->exec('/usr/bin/env', ['php', __DIR__.'/HTTP.php']);
}

(new swoole_process('processWebSocket'))->start();
(new swoole_process('processHTTP'))->start();
swoole_process::wait(true);
