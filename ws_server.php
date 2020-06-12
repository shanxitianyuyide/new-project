<?php
//创建websocket服务器对象，
$ws = new Swoole\WebSocket\Server('0.0.0.0', 9502);

//监听websocket链接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    //push发送消息
    $ws->push($request->fd, "hello,welcome\n");
});

//监听websocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

//监听websocket关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "clien-{$fd} is closed\n";
});

$ws->start();