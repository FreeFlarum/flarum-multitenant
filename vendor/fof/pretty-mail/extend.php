<?php

/*
 * This file is part of fof/pretty-mail.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace FoF\PrettyMail;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use FoF\PrettyMail\Providers\MailerProvider;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\ServiceProvider())
        ->register(MailerProvider::class),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(function (ForumSerializer $serializer, $model, array $attributes): array {
            if ($serializer->getActor()->isAdmin()) {
                $attributes['fof-pretty-mail.extra-template-attrs'] = array_keys(resolve('fof-pretty-mail.additional-data'));
            }
            return $attributes;
        }),
];
