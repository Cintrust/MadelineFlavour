<?php
/**
 * Created by Cintrust\MadelineProto\Observers\Messages\ProcessNewMessageType.
 * @see \Cintrust\MadelineProto\Observers\Messages\ProcessNewMessageType
 * User: Cintrust301
 * Date: Wednesday, 3rd July, 2019
 * Time: 04:48 AM, Europe/Berlin, +02:00
 */

namespace Cintrust\MadelineProto\Entities\Messages;


use Cintrust\MadelineProto\Entities\DefaultMessage;
/**
*Class MessageService
*
*
* @method bool     getOut()     _description_  
* @method bool     getMentioned()     _description_  
* @method bool     getMediaUnread()     _description_  
* @method bool     getSilent()     _description_  
* @method bool     getPost()     _description_  
* @method bool     getLegacy()     _description_  
* @method int|float     getId()     _description_  
* @method int|float     getFromId()     _description_  
* @method PeerChannel     getToId()     _description_  
* @method int|float     getReplyToMsgId()     _description_  
* @method int|float     getDate()     _description_  
* @method enum {eg. messageActionPinMessage}     getAction()     _description_
*
*
*
*/
class MessageService extends DefaultMessage
{

protected $observers =[];

}