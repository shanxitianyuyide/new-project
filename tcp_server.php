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
$serv = swoole_server($host, $port, $mode, $socke_type);

//使用
/**
 * $serv->on($event, $callback)
 * $event包含
 * connect: 当建立链接时
 * receive: 当接受到数据时
 * close： 关闭链接
 */
$event = 'connect';
$serv->on($event, function ($serv, $fd){
    var_dump($serv);
    var_dump($fd);
    echo '建立链接';
});