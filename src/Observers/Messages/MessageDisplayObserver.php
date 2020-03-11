<?php
/**
 * Created by PhpStorm
 * User: Junior Trust
 * Date: 12/25/2019
 * Time: 5:48 PM
 */

namespace Cintrust\MadelineProto\Observers\Messages;


use Cintrust\MadelineProto\Observers\Observer;

class MessageDisplayObserver extends Observer
{

    /**
     * @inheritDoc
     */
    public function handle()
    {
       yield $this->API->echo("\n message me : {$this->Entity->getMessage()} \n");
    }
}
