<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/10/2019
 * Time: 1:58 PM
 */

namespace Cintrust\MadelineProto\Observers\Messages;


use Cintrust\MadelineProto\Entities\DefaultMessage;
use Cintrust\MadelineProto\Observers\ProcessNewType;

class ProcessNewMessageType extends ProcessNewType
{


protected $type_dir =ENTITY_DIR.DIRECTORY_SEPARATOR.'Messages'.DIRECTORY_SEPARATOR;

protected $namespace ="Cintrust\MadelineProto\Entities\Messages";
//   Cintrust\MadelineProto\Entities\DefaultMessage
    protected $uses =[DefaultMessage::class];


    /**
     * @return bool|mixed
     */
    public function handle()
    {
        $payload =[
            '#extends#'=>"extends DefaultMessage"
        ];
        return $this->render($payload);

    }

    /**
     * @return string
     */
//    protected function getTemplate()
//    {
//       return <<<'TAG'
//<?php
///**
// * Created by #created_by#.
// * @see  \#user#
// * User: #user#
// * Date: #date#
// * Time: #time#
// */
//
//namespace ;
//
//
//use ;
//
///**
//* Class #class#
//*
//*
//*#docs#
//*
//*
//*/
//class #class# extends DefaultMessage
//{
//
//protected $observers =[];
//
//}
//TAG;
//    }
}
