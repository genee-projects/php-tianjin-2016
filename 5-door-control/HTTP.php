<?php

$server = new swoole_http_server("0.0.0.0", 3000);

$server->on('request', function ($request, $response) {

    $uri = $request->server['request_uri']; 
    if (!$uri || $uri=='/') {
        $uri = '/index.html';
    }

    printf("[HTTP] %s: %s \e[32m%s\e[0m\n",
        $request->server['remote_addr'], $request->server['request_method'],
        $uri);
 
    $root = rtrim(__DIR__, '/').'/web';
    $file = $root . '/'. ltrim($uri, '/'); 
    if (file_exists($file) && is_file($file)) { 
        $mime = mime_content_type($file);
        if ($mime == 'text/html') {
            $response->end(file_get_contents($file));
            return;
        }
        // $response->header('Content-Type', $mime);
        // $response->sendfile($file);
    }
    $response->end();
});

$server->on('start', function(swoole_http_server $server) {
    echo "[HTTP] 服务器开启...\n";
});

$server->start();
