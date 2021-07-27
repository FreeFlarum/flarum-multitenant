<?php

use Illuminate\Contracts\Events\Dispatcher;
use XEngine\Signature\Validation\ValidateSignature;
use XEngine\Signature\Model;
use Flarum\Extend;
use Flarum\User\User;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Frontend\Document;
use FoF\Components\Extend\AddFofComponents;

return [
    new AddFofComponents(),

    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><script>window.jQuery || document.write(\'<script src="js/vendor/jquery-3.3.1.min.js"><\/script>\')</script><script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.4.0/trumbowyg.js"></script>';
        }),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Flarum\Extend\ApiSerializer(UserSerializer::class))
        ->attributes(function (UserSerializer $serializer, User $user, array $attributes) {
            $attributes['signature'] = $user->signature;

            return $attributes;
        }),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/signature.less')
        ->css(__DIR__ . '/less/trumbowyg.less')
        ->route('/settings/signature', 'settings.signature', \Flarum\Forum\Content\AssertRegistered::class),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Routes('api'))
        ->post('/settings/signature/validate', 'settings.signature', ValidateSignature::class),

    (new Extend\Event())
        ->subscribe(Model\UserSignatureAttributes::class),
];
