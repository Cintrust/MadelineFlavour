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

defined('ROOT_NAMESPACE')|| define('ROOT_NAMESPACE',__NAMESPACE__);
defined('ENTITY_NAMESPACE')|| define('ENTITY_NAMESPACE',ROOT_NAMESPACE."\\Entities");
defined('OBSERVER_NAMESPACE')|| define('OBSERVER_NAMESPACE',ROOT_NAMESPACE."\\Observers");
defined('EXCEPTION_NAMESPACE')|| define('EXCEPTION_NAMESPACE',ROOT_NAMESPACE."\\Exceptions");
defined('ROOT_DIR')|| define('ROOT_DIR',__DIR__);
defined('ENTITY_DIR')|| define('ENTITY_DIR', __DIR__ . DIRECTORY_SEPARATOR);
defined('OBSERVER_DIR')|| define('OBSERVER_DIR', __DIR__ . DIRECTORY_SEPARATOR);
defined('EXCEPTION_DIR')|| define('EXCEPTION_DIR', __DIR__ . DIRECTORY_SEPARATOR);
defined('FILES_DIR')|| define('FILES_DIR',__DIR__.DIRECTORY_SEPARATOR."Files");


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
   isset($data['update'])||($data =['_'=>'update','update'=>$data]);
     $e = new DefaultEntity($data);
     return yield $e->getUpdate()->notify($this);
    }



}
