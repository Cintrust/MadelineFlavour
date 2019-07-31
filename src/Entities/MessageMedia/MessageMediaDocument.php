<?php
/**
 * Created by Cintrust\MadelineProto\Observers\ProcessNewType.
 * @see \Cintrust\MadelineProto\Observers\ProcessNewType
 * User: Cintrust301
 * Date: Friday, 5th July, 2019
 * Time: 10:44 AM, Europe/Berlin, +02:00
 */

namespace Cintrust\MadelineProto\Entities\MessageMedia;


use Cintrust\MadelineProto\Entities\DefaultDocument;
use Cintrust\MadelineProto\Entities\DefaultMessageMedia;
use Cintrust\MadelineProto\Entities\Documents\Document;

/**
*Class MessageMediaDocument
*
*
* @method Document     getDocument()     _description_  
*
*
*
*/
class MessageMediaDocument extends DefaultMessageMedia
{

protected $observers =[];


protected function subEntities()
{
     return [
         'document'=>[
             'document'=>Document::class,
             'default'=>DefaultDocument::class
         ]
     ];
}

}