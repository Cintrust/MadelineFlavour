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

                      return true;
                  }
    
                $message= $this->Entity->getMessage();
                if($message==="!off"){
                    yield $this->API->messages->sendMessage(
                          [
                              'peer' =>"@de_senior" ,
                              'message' => "goodbye cruel world",
                          ]
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
                    );
                    die();
                }
                if ($media = $this->Entity->getMedia()) {
                    yield $this->API->messages->sendMedia(
                        ['peer' => '@de_senior',
                            'message' => $message,
                            'media' =>$media->getRawData()
                            ]

                    );
                    
                    
                    if($photos =$media->getPhoto()){
                        yield $this->API->messages->sendMessage(
                            [
                                'peer' =>"@de_senior" ,
                                'message' => "you sent a photo ",
                            ]

                        );
    
    
    
                    }elseif($document =$media->getDocument()){
                        yield $this->API->messages->sendMessage(
                            [
                                'peer' =>"@de_senior" ,
                                'message' => "you sent a document ",
                            ]

                        );

                    }

                } else {
                    yield $this->API->messages->sendMessage(
                        ['peer' => '@de_senior', 'message' => $message?:"we got nothing"]
                    );
                }
                
                
            }
            
            return true;
        }
    }