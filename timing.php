<?php
//tick 定时器会持续触发
Swoole\Timer::tick(1000, function ($timer_id) {
    echo "定时器-{$timer_id}\n";
});

//after 定时器在指定的时间后执行，一次性定时器，执行完成后就会销毁
$str = 'swoole';
Swoole\Timer::after(5000, function () use ($str) {
    echo "定时器-{$str}\n";
});
