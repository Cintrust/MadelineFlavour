<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/10/2019
 * Time: 1:45 AM
 */

namespace Cintrust\MadelineProto\Observers\Updates;


use Cintrust\MadelineProto\Entities\DefaultUpdate;
use Cintrust\MadelineProto\Observers\ProcessNewType;

//use danog\MadelineProto\updates;

class ProcessNewUpdateType extends ProcessNewType
{

    protected $type_dir =    ROOT_DIR.DIRECTORY_SEPARATOR."Entities".DIRECTORY_SEPARATOR."Updates".DIRECTORY_SEPARATOR;

    protected $type_name="";

    protected $namespace ="Cintrust\MadelineProto\Entities\Updates";
    
    protected $uses =[DefaultUpdate::class];
    
    
    
    /**
     * @return bool|mixed
     */
    public function handle()
    {
        $payload =[
            '#extends#'=>"extends DefaultUpdate"
        ];
        return $this->render($payload);
        
    }

//protected function getTemplate()
//{
//    return <<<'TAG'
//<?php
///**
// * Created by #created_by#.
// * User: #user#
// * Date: #date#
// * Time: #time#
// */
//
//namespace Cintrust\MadelineProto\Entities\Updates;
//
//
//use Cintrust\MadelineProto\Entities\Update;
///**
//* Class #class#
//*
//*
//*#docs#
//*
//*
//*/
//class #class# extends Update
//{
//protected $observers =[];
//
//}
//TAG;
//
//}







}