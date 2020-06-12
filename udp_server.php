<?php
$serv = new swoole_server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$serv->on('Packet', function ($serv, $data, $fd) {
    $serv->sendto($fd['address'], $fd['port'], 'Server:' . $data);
    var_dump($fd);
});

$serv->start();