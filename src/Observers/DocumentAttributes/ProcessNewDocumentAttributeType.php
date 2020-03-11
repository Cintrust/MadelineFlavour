<?php
    
    
    namespace Cintrust\MadelineProto\Observers\DocumentAttributes;
    
    
    use Cintrust\MadelineProto\Entities\DefaultDocumentAttribute;
    use Cintrust\MadelineProto\Observers\ProcessNewType;

    class ProcessNewDocumentAttributeType extends ProcessNewType
    {
    
        protected $type_dir =ENTITY_DIR.DIRECTORY_SEPARATOR.'DocumentAttributes'.DIRECTORY_SEPARATOR;
    
        protected $namespace ="Cintrust\MadelineProto\Entities\DocumentAttributes";
//   Cintrust\MadelineProto\Entities\DefaultMessage
        protected $uses =[DefaultDocumentAttribute::class];
    
    
    
        /**
         * @return bool|mixed
         */
        public function handle()
        {
            $payload =[
                '#extends#'=>"extends DefaultDocumentAttribute"
            ];
            return $this->render($payload);
            
        
        }
        
        
    }