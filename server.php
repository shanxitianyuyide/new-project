<?php
$http = new swoole_http_server("0.0.0.0", 9501);

$http->on('request', function ($request, $response) {
    $response->header("Content-Type", "text/html; charset=utf-8");
    //输出
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
    var_dump($request->files);
});

$http->start();
