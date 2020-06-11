<?php
//建立tcp服务
/**
 * $host ip地址 监听多个ip时用 0.0.0.0
 * $port 端口
 * $mode SWOOLE_PROCESS 多进程的方式
 * $socke_type SWOOLE_SOCK_TYPE
 */
$host = '0.0.0.0';
$port = 9501;
$mode = 'SWOOLE_PROCESS';
$socke_type = 'SWOOLE_SOCK_TYPE';
$serv = new swoole_server($host, $port);

//使用
/**
 * $serv->on($event, $callback)
 * $event包含
 * connect: 当建立链接时
 * receive: 当接受到数据时
 * close： 关闭链接
 */
$event = 'connect';
//$serv 服务端信息  $fd 客户端信息
$serv->on($event, function ($serv, $fd){
//    var_dump($fd);
    echo "建立链接\n";
});

//$reactor_id 客户端ID   $data 接收数据
$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    echo "接受数据\n";
//    var_dump($reactor_id);
//    var_dump($data);
});

$serv->on('close', function ($serv, $fd) {
    echo '断开连接';
});

$serv->start();

