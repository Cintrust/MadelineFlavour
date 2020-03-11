<?php


    namespace Cintrust\MadelineProto\Observers\Messages;

    use Cintrust\MadelineProto\Loop\MyLoop;
    use danog\MadelineProto\Loop\Generic\GenericLoop;
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
//                $re=   MyLoop::getMe();
//                if($message=="Wow"){
//                    ($r=new MyLoop($this->API,10))->start();
//                    $r->resume();
//
//                    unset($r);
//                }
//                  if($message=="start"){
//                      if (!$re->start()) {
//                          $re->resume();
//                      }
//                  }elseif ($message=="off"){
//                      MyLoop::remove();
//                      unset($re);
////                      $re->waitSignal($re->pause(10));
//                  }elseif ($message=="pause"){
////                      MyLoop::remove();
////                      unset($re);
//                      $re->waitSignal($re->pause(10));
//                  }elseif ($message=="o"){
//
//                      $re->signal(2);
//                  }
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
