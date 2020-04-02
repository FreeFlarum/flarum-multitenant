<?php

namespace Dem13n\NickName\Changer\Listener;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\User\AssertPermissionTrait;
use Flarum\User\Event\Saving;
use Dem13n\NickName\Changer\Validators\NickNameValidator;


class SaveNickName
{
    use AssertPermissionTrait;

    protected $validator;

    public function __construct(NickNameValidator $validator)
    {
        $this->validator = $validator;
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'saveNickName']);
    }


    public function saveNickName(Saving $event)
    {
        $user = $event->user;
        $data = $event->data;
        $actor = $event->actor;

        $isSelf = $actor->id === $user->id;
        $canEdit = $actor->can('edit', $user);
        $attributes = array_get($data, 'attributes', []);

        if (isset($attributes['nickname'])) {
            if (!$isSelf) {
                $this->assertPermission($canEdit);
            }
            $user->nickname = $attributes['nickname'];
            $this->validator->assertValid($user->getAttributes());
            $user->save();
        }
    }
}
