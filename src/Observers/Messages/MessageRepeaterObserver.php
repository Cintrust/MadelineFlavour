<?php
    
    
    namespace Cintrust\MadelineProto\Observers\Messages;

    use danog\MadelineProto\Shutdown;
    use Cintrust\MadelineProto\Observers\Observer;
    
    /**
     * Class MessageRepeaterObserver
     * @package Cintrust\MadelineProto\Observers\Messages
     *
     * @property \Cintrust\MadelineProto\Entities\Messages\Message $Entity
     */
    class MessageRepeaterObserver extends Observer
    {
        
        
        /**
         * @return bool
         */
        public function handle()
        {
            if (
                (!$this->Entity->getOut())
                &&(($this->Entity->getDate()+1800)>=time())
            ) {
              $peer=  $this->Entity->getFromId();
                
                  if($peer!==654630358){
//                      yield $this->API->messages->sendMessage(
//                          [
//                              'peer' =>$this->Entity->getRawData() ,
//                              'message' => "you to our channel",
//                          ]
////                      $this->Entity->getRawData()
//                      );
                      return true;
                  }
//                                      print_r($this->Entity->getRawData());
    
                $message= $this->Entity->getMessage();
                if($message==="!off"){
                    yield $this->API->messages->sendMessage(
                          [
                              'peer' =>"@de_senior" ,
                              'message' => "goodbye cruel world",
                          ]
//                      $this->Entity->getRawData()
                      );
                    Shutdown::addCallback(static function () {
                        // This function will run on shutdown
                        exit();
    
                    },'restarter');
                    die();
                }elseif ($message==="!restart"){
    
                    yield $this->API->messages->sendMessage(
                        [
                            'peer' =>"@de_senior" ,
                            'message' => "restarting",
                        ]
//                      $this->Entity->getRawData()
                    );
                    die();
                }
//                print_r($this->Entity->getRawData());
                if ($media = $this->Entity->getMedia()) {
                    yield $this->API->messages->sendMedia(
                        ['peer' => '@de_senior',
                            'message' => $message,
                            'media' =>$media->getRawData()
                            ]
//                      $this->Entity->getRawData()
                    );
                    
                    
                    if($photos =$media->getPhoto()){
                        yield $this->API->messages->sendMessage(
                            [
                                'peer' =>"@de_senior" ,
                                'message' => "you sent a photo ",
                            ]
//                      $this->Entity->getRawData()
                        );
    
//                        echo "\n gate\n";
//                        print_r($photos->getRawData());
    
    
                    }elseif($document =$media->getDocument()){
                        yield $this->API->messages->sendMessage(
                            [
                                'peer' =>"@de_senior" ,
                                'message' => "you sent a document ",
                            ]
//                      $this->Entity->getRawData()
                        );
                        
//                        echo "\n gate\n";
    
//                        print_r($document->getRawData());
                    }
//                    $this->API->logger($media['_']);
//                    $time = microtime(true);
//                    $file = yield $this->API->download_to_file($media->getRawData(), FILES_DIR.);
//                    yield $this->API->messages->sendMessage(['peer' => $this->Entity->getFromId(),
//                        'message' =>
//                        'Downloaded to '.$file.' in '.(microtime(true) - $time).' seconds',
//                        'reply_to_msg_id' => $this->Entity->getId()]);

//                    print_r("\n\$media".str_repeat('=',60)."\n");
//                    print_r($media);
//                    print_r("\n\$media->getDocument()".str_repeat('=',60)."\n");
//                    print_r($media->getDocument());
//                    print_r("\n\$media->getDocument()->getMimeType()".str_repeat('=',60)."\n");
//                    print_r($media->getDocument()->getMimeType());
                } else {
                    yield $this->API->messages->sendMessage(
                        ['peer' => '@de_senior', 'message' => $message?:"we got nothing"]
//                      $this->Entity->getRawData()
                    );
                }
                
                
            }
            
            return true;
        }
    }