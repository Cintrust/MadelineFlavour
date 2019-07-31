<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/10/2019
 * Time: 1:44 PM
 */

namespace Cintrust\MadelineProto\Observers\Updates;


use Cintrust\MadelineProto\Observers\Observer;


/**
 * Class UpdateNewMessageObserver
 * @package Cintrust\MadelineProto\Observers\Updates
 *
 * @property \Cintrust\MadelineProto\Entities\Updates\UpdateNewMessage $Entity
 */
class
UpdateNewMessageObserver extends Observer
{

    /**
     * @return bool|mixed
     */
    public function handle()
    {
       return yield $this->Entity->getMessage()->notify($this->API);
    }
}