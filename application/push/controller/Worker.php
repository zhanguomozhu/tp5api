<?php
namespace app\push\controller;
use think\worker\Server;//加载workerman
use Workerman\Lib\Timer;
class Worker extends Server
{
    protected $socket = 'websocket://tp5api.com:2346';

    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {

        // // 进程启动时设置一个定时器，定时向所有客户端连接发送数据
        // $this->worker->onWorkerStart = function()
        // {
        //     // 定时，每10秒一次
        //     Timer::add(10, function(){
        //         // 遍历当前进程所有的客户端连接，发送当前服务器的时间
        //         foreach($$this->worker->connections as $connection)
        //         {
        //             $connection->send(time());

        //         }
        //     });
        // };
        foreach($this->worker->connections as $con)
        {
            $con->send($data);

        }
       // $connection->send('我收到你的信息了');
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
        echo 'aaaa';
    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}
