<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/9/2019
 * Time: 1:12 AM
 */

namespace Cintrust\MadelineProto;


use Cintrust\MadelineProto\Entities\DefaultEntity;
use Exception;

//use Cintrust\MadelineProto\Entities\Update;

defined('ROOT_NAMESPACE')|| define('ROOT_NAMESPACE',__NAMESPACE__,true);
defined('ENTITY_NAMESPACE')|| define('ENTITY_NAMESPACE',ROOT_NAMESPACE."\\Entities",true);
defined('OBSERVER_NAMESPACE')|| define('OBSERVER_NAMESPACE',ROOT_NAMESPACE."\\Observers",true);
defined('EXCEPTION_NAMESPACE')|| define('EXCEPTION_NAMESPACE',ROOT_NAMESPACE."\\Exceptions",true);
defined('ROOT_DIR')|| define('ROOT_DIR',__DIR__,true);
defined('ENTITY_DIR')|| define('ENTITY_DIR',__DIR__.DIRECTORY_SEPARATOR."Entities",true);
defined('OBSERVER_DIR')|| define('OBSERVER_DIR',__DIR__.DIRECTORY_SEPARATOR."Observers",true);
defined('EXCEPTION_DIR')|| define('EXCEPTION_DIR',__DIR__.DIRECTORY_SEPARATOR."Exceptions",true);
defined('FILES_DIR')|| define('FILES_DIR',__DIR__.DIRECTORY_SEPARATOR."Files",true);


trait Madeline
{
    public function initialize()
    {

    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function processUpdate(array $data)
    {
        $this->initialize();
/*//        echo "\n".__DIR__."\n";
        $sub = '\\Updates\\'. ucfirst($data['_']);
        $file_name =ENTITY_DIR.$sub.".php";
        file_exists($file_name) && include_once  $file_name;

        $update_class = ENTITY_NAMESPACE.$sub;
        if (class_exists($update_class)) {
            $update = new $update_class($data,"");
        }else{
            $update = new Update($data);
        }

*/

   isset($data['update'])||($data =['_'=>'update','update'=>$data]);
     $e = new DefaultEntity($data);
     return yield $e->getUpdate()->notify($this);
     
//     die();

//        print_r($GLOBALS['__composer_autoload_files']);
    }



}