<?php
/**
 * Created by Cintrust\MadelineProto\Observers\ProcessNewType.
 * @see \Cintrust\MadelineProto\Observers\ProcessNewType
 * User: Cintrust301
 * Date: Saturday, 6th July, 2019
 * Time: 12:06 AM, Europe/Berlin, +02:00
 */

namespace Cintrust\MadelineProto\Entities\Photos;


use Cintrust\MadelineProto\Entities\DefaultPhoto;
/**
* Class Photo
*
*
* @method boolean     getHasStickers()     _description_  
* @method string     getId()     _description_  
* @method string     getAccessHash()     _description_  
* @method \danog\MadelineProto\TL\Types\Bytes     getFileReference()     _description_  
* @method integer     getDate()     _description_  
* @method array     getSizes()     _description_  
* @method integer     getDcId()     _description_  
*
*
*
*/
class Photo extends DefaultPhoto
{

protected $observers =[];

}