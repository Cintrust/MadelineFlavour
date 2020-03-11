<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/10/2019
 * Time: 12:35 AM
 */

namespace Cintrust\MadelineProto\Observers;





abstract class Observer
{
    
    /**
     * @var \danog\MadelineProto\API $API
     */
    protected $API;
    
    /**
     * @var \Cintrust\MadelineProto\Entities\Entity $Entity
     */
    protected $Entity;
    public function __construct($api,$entity)
    {
//        echo "\n==================================\n";
//        echo static::class." was called";
//        echo "\n==================================\n";
        $this->API = $api;
        $this->Entity = $entity;
    }

    /**
     * @return bool
     */
     public abstract function handle();
}