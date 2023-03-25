<?php

use Flarum\Group\Group;
use Flarum\Database\Migration;


return Migration::addPermissions([
    'xelson-chat.permissions.enabled' => [Group::GUEST_ID],

    'xelson-chat.permissions.chat' => [Group::MEMBER_ID],
    'xelson-chat.permissions.create' => [Group::MEMBER_ID],
    'xelson-chat.permissions.edit' => [Group::MEMBER_ID],
    'xelson-chat.permissions.delete' => [Group::MEMBER_ID],

    'xelson-chat.permissions.create.channel' => [Group::MODERATOR_ID],
    'xelson-chat.permissions.moderate.delete' => [Group::MODERATOR_ID],
    'xelson-chat.permissions.moderate.vision' => [Group::MODERATOR_ID],
]);