<?php

namespace Cintrust\MadelineProto\Loop;

use danog\MadelineProto\Loop\Impl\ResumableSignalLoop;

class MyLoop extends ResumableSignalLoop
{
    private $timeout;

    public function __construct($API, $timeout)
    {
        $this->API = $API;
        $this->timeout = $timeout;

    }



    public function loop()
    {
        $MadelineProto = $this->API;
//        $logger = &$MadelineProto->logger;
        $e=0;
        while (true) {
            $t = time();
//            $this->timeout = 5;
            $result = yield $this->waitSignal($this->pause($this->timeout));
            ++$e;
            if($e > 2){
                echo("\n we are exiting loop\n");
                return;
            }
            $t=time()-$t;
            $result = yield $MadelineProto->echo(
                " \n $e } Resumed after $t seconds of timeout $result  {$this->timeout}\n"
            );
        }
    }

    public static function test($madeline)
    {
        ($r=new MyLoop($madeline,10))->start();
        $value = 45;
//        $r->resume($value); // when this is used, the destructor of the instance will be called but $value will not be passed on
        $r->signal($value); // when this is used the destructor of the  instance will not be called but $value will be passed on
//        $r->pause(10) // stops the instance loop forever, destructor is not called either
        unset($r);
    }
    public function __destruct()
    {
        echo("===================== i am no {$this->timeout} j ================================= \n");
    }
    public function __toString(): string
    {
        return "my cron signal loop";
    }
}
