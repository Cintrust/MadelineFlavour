<?php
    
    
    namespace Cintrust\MadelineProto\Entities;
    
    
    use Cintrust\MadelineProto\Observers\MessageMedia\ProcessNewMessageMediaType;

    class DefaultMessageMedia extends Entity
    {
        protected $observers =[ProcessNewMessageMediaType::class];
    }