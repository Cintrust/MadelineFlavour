<?php
    
    
    namespace Cintrust\MadelineProto\Entities;
    
    
    use Cintrust\MadelineProto\Observers\DocumentAttributes\ProcessNewDocumentAttributeType;

    class DefaultDocumentAttribute extends Entity
    {
        protected $observers =[
            ProcessNewDocumentAttributeType::class
        ];
    }