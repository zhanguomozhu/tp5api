<?php
namespace org;
    /*使用微秒计算脚本运行时间的类库

    单位:微秒

    */

   //声明一个计算脚本运行时间的类

class Times{

    private $startTime = 0; //保存脚本开始执行时的时间

    private $stopTime = 0;  //保存脚本结束执行时的时间

    //在脚本开始处调用获取脚本开始时间时的微秒值

    function start(){

        $this->startTime = microtime(true);

    }

    //在脚本结束时调用获取脚本结束时间的微秒值

    function stop(){

        $this->stopTime = microtime(true);

    }

    //返回同一脚本中两次获取时间的差值

    function spent(){

        return round(($this->stopTime - $this->startTime),4);

    }


}

  //  使用示例

    // header("Content-type: text/html; charset=utf-8");

    // $time = new Times();

    // $time->start();

    // usleep(2000);   //休眠二毫秒,用来测试

    // $time->stop();

    // echo "执行该脚本用时".$time->spent()."s";