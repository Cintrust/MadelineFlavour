<?php
/**
 * Created by Cintrust\MadelineProto\Observers\Messages\ProcessNewMessageType.
 * @see \Cintrust\MadelineProto\Observers\Messages\ProcessNewMessageType
 * User: Cintrust301
 * Date: Wednesday, 3rd July, 2019
 * Time: 04:36 AM, Europe/Berlin, +02:00
 */

namespace Cintrust\MadelineProto\Entities\Messages;


use Cintrust\MadelineProto\Entities\DefaultMessage;
use Cintrust\MadelineProto\Entities\DefaultMessageMedia;
use Cintrust\MadelineProto\Entities\DefaultPeer;
use Cintrust\MadelineProto\Entities\MessageMedia\MessageMediaDocument;
use Cintrust\MadelineProto\Entities\MessageMedia\MessageMediaPhoto;
use Cintrust\MadelineProto\Entities\MessageMedia\MessageMediaUnsupported;
use Cintrust\MadelineProto\Entities\Peers\PeerChannel;
use Cintrust\MadelineProto\Entities\Peers\PeerUser;
use Cintrust\MadelineProto\Observers\Messages\MessageRepeaterObserver;

/**
*Class Message
*
*
* @method bool     getOut()     _description_  
* @method bool     getMentioned()     _description_  
* @method bool     getMediaUnread()     _description_  
* @method bool     getSilent()     _description_  
* @method bool     getPost()     _description_  
* @method bool     getFromScheduled()     _description_  
* @method bool     getLegacy()     _description_  
* @method int|float     getId()     _description_  
* @method int|float     getFromId()     _description_  
* @method PeerChannel|PeerUser     getToId()     _description_
* @method int|float     getDate()     _description_  
* @method string     getMessage()     _description_  
* @method   MessageMediaDocument|MessageMediaPhoto|DefaultMessageMedia   getMedia()     _description_
*
*
*
*/
class Message extends DefaultMessage
{

protected $observers =[
    MessageRepeaterObserver::class,
];

protected function subEntities()
{
    return [
        'to_id'=>[
            'peerChannel'=>PeerChannel::class,
            'peerUser'=>PeerUser::class,
            'default'=>DefaultPeer::class
        ],
        'media'=>[
            'messageMediaDocument'=>MessageMediaDocument::class,
            'messageMediaPhoto'=>MessageMediaPhoto::class,
            'messageMediaUnsupported'=>MessageMediaUnsupported::class,
            
            'default'=>DefaultMessageMedia::class
        ]
    ];
    
}
}