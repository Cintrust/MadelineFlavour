<?php
    
    
    namespace Cintrust\MadelineProto\Observers\Peers;
    
    
    use Cintrust\MadelineProto\Entities\DefaultPeer;
    use Cintrust\MadelineProto\Observers\ProcessNewType;

    class ProcessNewPeerType extends ProcessNewType
    {
    
        protected $type_dir =ENTITY_DIR.DIRECTORY_SEPARATOR.'Peers'.DIRECTORY_SEPARATOR;
    
        protected $namespace ="Cintrust\MadelineProto\Entities\Peers";
//   Cintrust\MadelineProto\Entities\DefaultMessage
        protected $uses =[DefaultPeer::class];
    
    
        /**
         * @return bool|mixed
         */
        public function handle()
        {
            $payload =[
                '#extends#'=>"extends DefaultPeer"
            ];
            return $this->render($payload);
        
        }
    }