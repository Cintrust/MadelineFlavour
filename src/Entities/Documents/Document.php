<?php
    /**
     * Created by Cintrust\MadelineProto\Observers\ProcessNewType.
     * @see \Cintrust\MadelineProto\Observers\ProcessNewType
     * User: Cintrust301
     * Date: Friday, 5th July, 2019
     * Time: 11:27 AM, Europe/Berlin, +02:00
     */
    
    namespace Cintrust\MadelineProto\Entities\Documents;
    
    
    use Cintrust\MadelineProto\Entities\DefaultDocument;
    use Cintrust\MadelineProto\Entities\DefaultDocumentAttribute;
    use Cintrust\MadelineProto\Entities\DocumentAttributes\DocumentAttributeAnimated;
    use Cintrust\MadelineProto\Entities\DocumentAttributes\DocumentAttributeFilename;
    use Cintrust\MadelineProto\Entities\DocumentAttributes\DocumentAttributeVideo;
    
    /**
     *Class Document
     *
     *
     * @method string     getId()     _description_
     * @method string     getAccessHash()     _description_
     * @method \danog\MadelineProto\TL\Types\Bytes     getFileReference()     _description_
     * @method integer     getDate()     _description_
     * @method string     getMimeType()     _description_
     * @method integer     getSize()     _description_
     * @method array     getThumbs()     _description_
     * @method integer     getDcId()     _description_
     * @method DefaultDocumentAttribute[]    getAttributes()     _description_
     *
     *
     *
     */
    class
    Document extends DefaultDocument
    {
        
        protected $observers = [];
        
        
        protected function subEntities()
        {
            return [
                'attributes' => [
                    'documentAttributeAnimated' => DocumentAttributeAnimated::class,
                    'documentAttributeFilename' => DocumentAttributeFilename::class,
                    'documentAttributeVideo' => DocumentAttributeVideo::class,
                    'default' => DefaultDocumentAttribute::class
                ]
            ];
        }
        
    }