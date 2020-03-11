<?php
/**
 * Created by Cintrust\MadelineProto\Observers\Updates\ProcessNewUpdateType.
 * @see \Cintrust\MadelineProto\Observers\Updates\ProcessNewUpdateType
 * User: Cintrust301
 * Date: Thursday, 21st November, 2019
 * Time: 01:16 AM, Africa/Lagos, +01:00
 */

namespace Cintrust\MadelineProto\Entities\Updates;


use Cintrust\MadelineProto\Entities\DefaultUpdate;
/**
* Class UpdateServiceNotification
*
*
* @method boolean     getPopup()     _description_
* @method integer     getInboxDate()     _description_
* @method string     getType()     _description_
* @method string     getMessage()     _description_
* @method array     getMedia()     _description_
* @method array     getEntities()     _description_
*
*
*
*/
class UpdateServiceNotification extends DefaultUpdate
{

protected $observers = [];

}
