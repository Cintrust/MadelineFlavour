<?php
    
    
    
    
    
    require_once  ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
    date_default_timezone_set('Africa/Lagos');
    
    
    use Cintrust\MadelineProto\Madeline;
    use danog\MadelineProto\API;
    use danog\MadelineProto\EventHandler as MadelineProtoEventHandler;
//    use danog\MadelineProto\Loop\Generic\GenericLoop;
//    use danog\MadelineProto\Shutdown;

//    use danog\MadelineProto\RPCErrorException;
    
    class EventHandNew extends MadelineProtoEventHandler
    {
        use Madeline;
        
        
        
        
        public function __construct($MadelineProto)
        {
            parent::__construct($MadelineProto);
            
            
        }
        
        public function onUpdateSomethingElse($update)
        {
            // See the docs for a full list of updates: http://docs.madelineproto.xyz/API_docs/types/Update.html
        }
        
       
        
        /**
         * @param $update
         * @return Generator|void
         * @throws Exception
         */
        public function onAny($update)
        {


            
             yield $this->processUpdate($update);
             
            return;
            
        }
       
    }
    
    
    
    $settings = ['logger' => [
        'logger_level' => 5,
        'logger' => 3,
    ]];
    
    $time = microtime(true);
    echo $time;
    $MadelineProto = new API('user.madeline', $settings);
    
    
   


//    while(1) {
        try {
            $MadelineProto->async(true);
            $MadelineProto->loop(function () use ($MadelineProto) {
                yield $MadelineProto->start();
                yield $MadelineProto->setEventHandler(EventHandNew::class);
            });
            $MadelineProto->loop();
        
        } catch (\Throwable|\Exception|\Error $e) {
            $msg = "Error: {$e->getMessage()}\n Trace:  {$e->getTraceAsString()} ";
            \danog\MadelineProto\Logger::log($msg);
        
            $MadelineProto->wait((function () use (&$MadelineProto, $msg) {
            
                try {
                    yield  $MadelineProto->messages->sendMessage([
                        'peer' => '@RhemaRay',
                        'message' => $msg
                    ]);
                } catch (\Throwable|\Exception|\Error $e) {
                    $msg = "why me Error: {$e->getMessage()}\n Trace:  {$e->getTraceAsString()} ";
                    \danog\MadelineProto\Logger::log($msg);
                
                }
            })());
        
        
        }
//    }
