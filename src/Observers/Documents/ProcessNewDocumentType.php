<?php
    
    
    namespace Cintrust\MadelineProto\Observers\Documents;
    
    
    use Cintrust\MadelineProto\Entities\DefaultDocument;
    use Cintrust\MadelineProto\Observers\ProcessNewType;
    
    class ProcessNewDocumentType extends ProcessNewType
    {
        protected $type_dir = ENTITY_DIR . DIRECTORY_SEPARATOR . 'Documents' . DIRECTORY_SEPARATOR;
        
        protected $namespace = "Cintrust\MadelineProto\Entities\Documents";
        
        protected $uses = [DefaultDocument::class];
        
        /**
         * @return bool|mixed
         */
        public function handle()
        {
            $payload = [
                '#extends#' => "extends DefaultDocument"
            ];
            return $this->render($payload);
            
        }
        
    }