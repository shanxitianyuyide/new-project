<?php

$redis = new Redis();
$redis->connect('127.0.0.1', '6379');
$listKey = '20200529_goods_list';
//$redis->lTrim($listKey, 1, 30);


//$res = getGoodsList($redis, $listKey);
//var_dump($res);

kill($redis, $listKey);
//echo $row;

//$row = $redis->hGetAll('20200529_buy_order');
//print_r($row);
/*
 * 添加商品
 */
function addGoods($redis, $listKey)
{
    $count = 30;

    for ($i = 0; $i < $count; $i++) {
        $redis->rPush($listKey, $i);
    }
}

function getGoodsList($redis, $listKey)
{
    $goods = $redis->lRange($listKey, 0, -1);
    return $goods;
}

function kill($redis, $listKey)
{
    //用户id
    $uuid = md5(uniqid('user') . time());
    $orderKey = '20200529_buy_order';
    $failuser = '20200529_fail_user';
    $goodsId = $redis->lPop($listKey);
    if ($goodsId) {
        $redis->hSet($orderKey, $goodsId, $uuid);
    } else {
        $redis->incr($failuser);
    }
    echo 'SUCCESS';
}


