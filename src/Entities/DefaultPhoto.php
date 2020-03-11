<?php
    
    
    namespace Cintrust\MadelineProto\Entities;
    
    
    use Cintrust\MadelineProto\Observers\Photos\ProcessNewPhotoType;

    class DefaultPhoto extends Entity
    {
        protected $observers= [ProcessNewPhotoType::class];
    
    }