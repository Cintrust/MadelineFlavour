<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/9/2019
 * Time: 1:41 AM
 */

namespace Cintrust\MadelineProto\Entities;


use Cintrust\MadelineProto\Observers\Updates\ProcessNewUpdateType;

class DefaultUpdate extends Entity
{

//    private $me = null;

protected $observers = [ProcessNewUpdateType::class];




}