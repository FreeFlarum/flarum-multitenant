<?php

namespace ClarkWinkelmann\AuthorChange\Extenders;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class ForumAttributes implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Serializing::class, [$this, 'attributes']);
    }

    public function attributes(Serializing $event)
    {
        if ($event->isSerializer(ForumSerializer::class)) {
            $event->attributes['clarkwinkelmannAuthorChangeCanEditUser'] = $event->actor->can('clarkwinkelmann-author-change.edit-user');
            $event->attributes['clarkwinkelmannAuthorChangeCanEditDate'] = $event->actor->can('clarkwinkelmann-author-change.edit-date');
        }
    }
}
