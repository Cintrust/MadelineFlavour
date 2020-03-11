<?php
    
    
    namespace Cintrust\MadelineProto\Observers\Photos;
    
    
    use Cintrust\MadelineProto\Entities\DefaultPhoto;
    use Cintrust\MadelineProto\Observers\ProcessNewType;

    class ProcessNewPhotoType extends ProcessNewType
    {
    
        protected $type_dir =ENTITY_DIR.DIRECTORY_SEPARATOR.'Photos'.DIRECTORY_SEPARATOR;
    
        protected $namespace ="Cintrust\MadelineProto\Entities\Photos";
//   Cintrust\MadelineProto\Entities\DefaultMessage
        protected $uses =[DefaultPhoto::class];
    
    
        /**
         * @return bool|mixed
         */
        public function handle()
        {
            $payload =[
                '#extends#'=>"extends DefaultPhoto"
            ];
            return $this->render($payload);
        
        }
    }