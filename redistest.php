<?php

addGoods();

/*
 * 添加商品
 */
function addGoods()
{
    $count = 30;
    $listKey = '20200529_goods_list';

    $redis = new Redis();
    $redis->connect('127.0.0.1', '6379');

    for ($i = 0; $i < $count; $i++) {
        $redis->rPush($listKey, $i);
    }

    $goods = $redis->lRange($listKey, 0, -1);
    return $goods;
}



