<?php
/**
 * Created by Cintrust\MadelineProto\Observers\Updates\ProcessNewUpdateType.
 * @see \Cintrust\MadelineProto\Observers\Updates\ProcessNewUpdateType
 * User: Cintrust301
 * Date: Saturday, 6th July, 2019
 * Time: 05:15 AM, Europe/Berlin, +02:00
 */

namespace Cintrust\MadelineProto\Entities\Updates;


use Cintrust\MadelineProto\Entities\DefaultUpdate;
/**
* Class UpdateReadHistoryOutbox
*
*
* @method array     getPeer()     _description_  
* @method integer     getMaxId()     _description_  
* @method integer     getPts()     _description_  
* @method integer     getPtsCount()     _description_  
*
*
*
*/
class UpdateReadHistoryOutbox extends DefaultUpdate
{

protected $observers =[];

}