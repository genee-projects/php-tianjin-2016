<?php

$server = new swoole_http_server("0.0.0.0", 3000);

$server->on('request', function ($request, $response) {
    $uri = $request->server['request_uri']; 

    $root = rtrim(__DIR__, '/').'/web';
    $file = $root . '/'. ltrim($uri, '/'); 
    if (file_exists($file) && is_file($file)) { 
        $mime = mime_content_type($file);
        $response->header('Content-Type', $mime); 
        $response->sendfile($file); 
        return; 
    } 

    $content = file_get_contents($root.'/index.html');
    $response->end($content);
});

$server->on('start', function(swoole_http_server $server) {
    echo "HTTP服务器开启...\n";
});

$server->start();
