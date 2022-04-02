<?php

/*
 * This file is part of askvortsov/flarum-discussion-templates
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumDiscussionTemplates;

use Askvortsov\FlarumDiscussionTemplates\Access\DiscussionPolicy;
use Askvortsov\FlarumDiscussionTemplates\Listener\SaveReplyTemplateToDatabase;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Extend;
use Flarum\Tags\Api\Serializer\TagSerializer;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Routes('api'))
        ->patch('/tags/{id}/template', 'tags.updateTemplate', Controller\UpdateTagTemplateController::class),

    (new Extend\ApiSerializer(TagSerializer::class))
        ->attribute('template', function ($serializer, $model) {
            return $model->template;
        }),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->attribute('replyTemplate', function ($serializer, $model) {
            return $model->replyTemplate;
        })
        ->attribute('canManageReplyTemplates', function ($serializer, $model) {
            return $serializer->getActor()->can('manageReplyTemplates', $model);
        }),

    (new Extend\Policy())
        ->modelPolicy(Discussion::class, DiscussionPolicy::class),

    (new Extend\Event())
        ->listen(Saving::class, SaveReplyTemplateToDatabase::class),

    (new Extend\Settings())
        ->serializeToForum('askvortsov-discussion-templates.no_tag_template', 'askvortsov-discussion-templates.no_tag_template')
        ->serializeToForum('appendTemplateOnTagChange', 'appendTemplateOnTagChange', 'boolval'),
];
