<?php
    
    
    namespace Cintrust\MadelineProto\Entities;
    
    
    use Cintrust\MadelineProto\Observers\Documents\ProcessNewDocumentType;

    class DefaultDocument extends Entity
    {
    
        protected $observers =[ProcessNewDocumentType::class];
    }