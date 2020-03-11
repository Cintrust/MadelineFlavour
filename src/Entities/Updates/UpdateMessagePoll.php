<?php
/**
 * Created by Cintrust\MadelineProto\Observers\Updates\ProcessNewUpdateType.
 * @see \Cintrust\MadelineProto\Observers\Updates\ProcessNewUpdateType
 * User: Cintrust301
 * Date: Wednesday, 3rd July, 2019
 * Time: 04:55 AM, Europe/Berlin, +02:00
 */

namespace Cintrust\MadelineProto\Entities\Updates;


use Cintrust\MadelineProto\Entities\DefaultUpdate;
/**
*Class UpdateMessagePoll
*
*
* @method string     getPollId()     _description_  
* @method Poll     getPoll()     _description_  
* @method PollResults     getResults()     _description_  
*
*
*
*/
class UpdateMessagePoll extends DefaultUpdate
{

protected $observers =[];

}