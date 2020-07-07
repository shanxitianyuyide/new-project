<?php
class SwooleWebsocket
{
    public $websocket;

    public function __construct()
    {
        $this->websocket = new Swoole\WebSocket\Server("0.0.0.0", 9501);
        //监听客户端链接
        $this->websocket->on('open', function (Swoole\WebSocket\Server $server, $request) {
            $fd[] = $request->fd;
            $GLOBALS['fd'][] = $fd;
        });
        //监听websocket消息事件
        $this->websocket->on('message', function (Swoole\WebSocket\Server $server, $frame) {
            $msg =  'from'.$frame->fd.":{$frame->data}\n";
            foreach($GLOBALS['fd'] as $aa){
                foreach($aa as $i){
                    $this->websocket->push($i,$msg);
                }
            }
        });

        $this->websocket->on('close', function ($ser, $fd) {
            echo "client-{$fd} is closed\n";
        });

        $this->websocket->start();
    }
}
new SwooleWebsocket();
