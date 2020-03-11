<?php
    
    
    namespace Cintrust\MadelineProto\Observers\MessageMedia;
    
    
    use Cintrust\MadelineProto\Entities\DefaultMessageMedia;
    use Cintrust\MadelineProto\Observers\ProcessNewType;

    class ProcessNewMessageMediaType extends ProcessNewType
    {
        protected $type_dir =ENTITY_DIR.DIRECTORY_SEPARATOR.'MessageMedia'.DIRECTORY_SEPARATOR;
    
        protected $namespace ="Cintrust\MadelineProto\Entities\MessageMedia";
    
        protected $uses =[DefaultMessageMedia::class];
    
        /**
         * @return bool|mixed
         */
        public function handle()
        {
            $payload =[
                '#extends#'=>"extends DefaultMessageMedia"
            ];
            return $this->render($payload);
        
        }
        
    }