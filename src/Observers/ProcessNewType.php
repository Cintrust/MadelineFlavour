<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/11/2019
 * Time: 2:56 AM
 */

namespace Cintrust\MadelineProto\Observers;


use Cintrust\MadelineProto\Entities\Entity;

class ProcessNewType extends Observer
{

    protected $type_dir = ENTITY_DIR . DIRECTORY_SEPARATOR . "NewEntityTypes" . DIRECTORY_SEPARATOR;

    protected $type_name = "";
    
    protected $namespace ="Cintrust\MadelineProto\Entities\NewEntityTypes";
//    Cintrust\MadelineProto\Entities\Entity
    protected $uses =[Entity::class];


    public function __construct($api,  $entity)
    {
        $this->type_name = ucfirst($entity->getType());
        parent::__construct($api, $entity);
    }

    /**
     * @return bool|mixed
     */
    public function handle()
    {
        $payload =[
            '#extends#'=>"extends Entity"
        ];
        $this->render($payload);

        return true;
    }

    /**
     * @param array|string $temp
     * @return bool
     */
    protected function render($temp =[])
    {
        $file_path = $this->type_dir . $this->type_name . ".php";
        if (file_exists($file_path)) {
//            $line = "\n".str_repeat('=',80)."\n";
//            Logger::log(file_get_contents($file_path));
//            Logger::log("$line $file_path already exist \nconsider updating the SubEntities of the necessary Entity. $line", Logger::FATAL_ERROR);
    
            return true;
        }
        if(is_array($temp))
        $temp = $this->process($temp);

        echo "\n";
        echo $temp;
        echo "\n";
        file_put_contents($file_path, $temp);
        return true;
    }
    
    public function getDataTypeM($data,$default="mixed")
    {
        
        
        if(is_bool($data)){
            return "bool";
        }elseif(is_numeric($data)){
            return "int|float";
        }elseif (is_string($data)){
            return ($data=="false"||$data=="true")?'bool':"string";
        }elseif (is_array($data)){
              if(isset($data['_']))
                  return (count($data)>1)? ucfirst($data['_']): "enum {eg. {$data['_']} }";
            
            return "array";
        }elseif (is_object($data)){
            /** @var object $data */
            return "\\".get_class($data);

        }else
        return $default;
    }
    
    public function getDataType($data,$default="mixed")
    {
        $type = gettype($data);
        if($type=="object"){
            return "\\".get_class($data);
        }elseif ($type=="string"){
            return ($data=="false"||$data=="true")?'bool':"string";
    
        }elseif($type=="unknown type"){
            
            return "$default|($type)";
            
        }else {
            return $type;
        }
    
    }
    public function processProperties()
    {
       
        $data =$this->Entity->getRawData();
        $line="";
    
        if(isset($data['_']))
            unset($data['_']);
        
        foreach ($data as $key=>$value){
            $method = "get".str_replace('_', '', ucwords($key, '_'))."()";
            
            $line.=" @method {$this->getDataType($value)}     $method     _description_  \n*";
            
        }
        return $line;
    }
    /**
     * @param array $data
     * @return mixed|string
     */
    protected function process(array $data = [])
    {
        $temp = $this->getTemplate();
        echo "\n";
        echo $temp;
        echo "\n";
        foreach ($data as $key => $datum) {
            $temp = str_replace($key, $datum, $temp);
        }
       
        return $temp;
    }

    protected function getTemplate()
    {
        $uses = implode(";\nuse ",$this->uses);
        $created_by = static::class;
        $user = ucfirst($this->Entity->getBotUsername());
        $date = date("l, jS F, Y");
        $time = date("h:i A, e, P");
        $docs = $this->processProperties();
        $class= ucfirst($this->Entity->getType());
    
        return <<<TAG
<?php
/**
 * Created by $created_by.
 * @see \\$created_by
 * User: $user
 * Date: $date
 * Time: $time
 */

namespace $this->namespace;


use $uses;
/**
* Class $class
*
*
*$docs
*
*
*/
class $class #extends#
{

protected \$observers =[];

}
TAG;
    }

}