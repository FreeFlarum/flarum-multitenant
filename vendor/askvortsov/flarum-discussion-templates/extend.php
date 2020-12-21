<?php

/*
 * This file is part of askvortsov/flarum-discussion-templates
 *
 *  Copyright (c) 2020 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumDiscussionTemplates;

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
];
