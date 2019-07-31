<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/9/2019
 * Time: 3:10 AM
 */

namespace Cintrust\MadelineProto\Entities\Updates;


use Cintrust\MadelineProto\Entities\DefaultMessage;
use Cintrust\MadelineProto\Entities\Messages\Message;
use Cintrust\MadelineProto\Entities\Messages\MessageService;
use Cintrust\MadelineProto\Entities\DefaultUpdate;
use Cintrust\MadelineProto\Exceptions\InvalidEntity;
use Cintrust\MadelineProto\Observers\Updates\UpdateNewMessageObserver;

/**
 * Class UpdateNewMessage
 *
 *
 * @method Message|MessageService|DefaultMessage     getMessage()     _description_
 * @method int|float     getPts()     _description_
 * @method int|float     getPtsCount()     _description_
 *
 *
 *
 */
class UpdateNewMessage extends DefaultUpdate
{
protected $observers =[UpdateNewMessageObserver::class];


    /**
     * @throws InvalidEntity
     */
    protected function validate()
{
    parent::validate(); // TODO: Change the autogenerated stub
    if(!isset($this->getProperty('raw_data')['message'])){
        throw new InvalidEntity('Invalid entity data given: '.json_encode($this->getRawData(),JSON_PRETTY_PRINT));
    }
}

protected function subEntities()
{
    return [
        'message'=>[
            'message'=> Message::class,
            'messageService'=> MessageService::class,
            'default' =>DefaultMessage::class
        ]
    ];
}

}