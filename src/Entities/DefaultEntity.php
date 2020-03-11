<?php
/**
 * Created by PhpStorm.
 * User: CINTRUST
 * Date: 1/10/2019
 * Time: 9:39 PM
 */

namespace Cintrust\MadelineProto\Entities;


use Cintrust\MadelineProto\Entities\Updates\UpdateChannel;
use Cintrust\MadelineProto\Entities\Updates\UpdateChannelMessageViews;
use Cintrust\MadelineProto\Entities\Updates\UpdateChatUserTyping;
use Cintrust\MadelineProto\Entities\Updates\UpdateDeleteChannelMessages;
use Cintrust\MadelineProto\Entities\Updates\UpdateDeleteMessages;
use Cintrust\MadelineProto\Entities\Updates\UpdateEditChannelMessage;
use Cintrust\MadelineProto\Entities\Updates\UpdateEditMessage;
use Cintrust\MadelineProto\Entities\Updates\UpdateMessageID;
use Cintrust\MadelineProto\Entities\Updates\UpdateMessagePoll;
use Cintrust\MadelineProto\Entities\Updates\UpdateNewChannelMessage;
use Cintrust\MadelineProto\Entities\Updates\UpdateNewMessage;
use Cintrust\MadelineProto\Entities\Updates\UpdateNotifySettings;
use Cintrust\MadelineProto\Entities\Updates\UpdatePeerSettings;
use Cintrust\MadelineProto\Entities\Updates\UpdateReadChannelInbox;
use Cintrust\MadelineProto\Entities\Updates\UpdateReadFeaturedStickers;
use Cintrust\MadelineProto\Entities\Updates\UpdateReadHistoryInbox;
use Cintrust\MadelineProto\Entities\Updates\UpdateReadHistoryOutbox;
use Cintrust\MadelineProto\Entities\Updates\UpdateReadMessagesContents;
use Cintrust\MadelineProto\Entities\Updates\UpdateServiceNotification;

use Cintrust\MadelineProto\Entities\Updates\UpdateUserName;
use Cintrust\MadelineProto\Entities\Updates\UpdateUserPhoto;
use Cintrust\MadelineProto\Entities\Updates\UpdateUserStatus;
use Cintrust\MadelineProto\Entities\Updates\UpdateUserTyping;
use Cintrust\MadelineProto\Observers\ProcessNewType;

/**
 * @method DefaultUpdate getUpdate()
 */
class DefaultEntity extends Entity
{

    protected $observers =[ProcessNewType::class];
    /**
     * @inheritdoc
     * @see \Cintrust\MadelineProto\Entities\Entity::subEntities()
     * @return array
     *
     *
     */
    protected function subEntities()
{
    return [
      'update'  =>[
          'updateChannel'=>UpdateChannel::class,
          'UpdateChannelMessageViews'=>UpdateChannelMessageViews::class,
          'UpdateChatUserTyping'=>UpdateChatUserTyping::class,
          'updateDeleteChannelMessages'=>UpdateDeleteChannelMessages::class,
          'updateDeleteMessages'=>UpdateDeleteMessages::class,
          'updateEditChannelMessage'=>UpdateEditChannelMessage::class,
          'updateEditMessage'=>UpdateEditMessage::class,
          'updateMessageID'=>UpdateMessageID::class,
          'updateMessagePoll'=>UpdateMessagePoll::class,
          'updateNewChannelMessage'=>UpdateNewChannelMessage::class,
          'updateNewMessage'=>UpdateNewMessage::class,
          'updateNotifySettings'=>UpdateNotifySettings::class,
          'updatePeerSettings'=>UpdatePeerSettings::class,
          'updateReadChannelInbox'=>UpdateReadChannelInbox::class,
          'updateReadFeaturedStickers'=>UpdateReadFeaturedStickers::class,
          'updateReadHistoryInbox'=>UpdateReadHistoryInbox::class,
          'updateReadHistoryOutbox'=>UpdateReadHistoryOutbox::class,
          'updateReadMessagesContents'=>UpdateReadMessagesContents::class,
          'UpdateServiceNotification'=>UpdateServiceNotification::class,
          'updateUserName'=>UpdateUserName::class,
          'updateUserPhoto'=>UpdateUserPhoto::class,
          'updateUserStatus'=>UpdateUserStatus::class,
          'updateUserTyping'=>UpdateUserTyping::class,
          'default'=>DefaultUpdate::class,
      ]
    ];
}

}

