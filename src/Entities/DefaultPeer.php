<?php
    
    
    namespace Cintrust\MadelineProto\Entities;
    
    
    use Cintrust\MadelineProto\Observers\Peers\ProcessNewPeerType;

    class DefaultPeer extends Entity
    {
        protected $observers= [ProcessNewPeerType::class];
    }