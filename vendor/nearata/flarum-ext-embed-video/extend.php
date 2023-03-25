<?php

namespace Nearata\EmbedVideo;

use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Extend;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Post\Event\Saving;
use Flarum\Post\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Formatter)
        ->configure(function (Configurator $config) {
            $config->BBCodes->addCustom(
                '[embed-video
                    id="{TEXT}"
                    url="{ANYTHING}"
                    type="{TEXT2}"
                    live="{TEXT3}"
                    qualities="{ANYTHING2;optional}"
                ]',
                '<div
                    id="player-{TEXT}"
                    class="dplayer-container"
                    data-url="{ANYTHING}"
                    data-type="{TEXT2}"
                    data-live="{TEXT3}"
                    data-qualities="{ANYTHING2}"
                >
                </div>'
            );
        }),

    (new Extend\Event)
        ->listen(Saving::class, function(Saving $event) {
            if (Arr::has($event->data, 'attributes.content')) {
                $content = Arr::get($event->data, 'attributes.content');

                if (!Str::contains($content, 'embed-video')) {
                    return;
                }

                $event->actor->assertCan('nearata.embedvideo.create');
            }
        }),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(ForumSettings::class),

    (new Extend\ApiSerializer(BasicPostSerializer::class))
        ->attributes(function (BasicPostSerializer $serializer, Post $post, array $attributes) {
            if ($post->type != 'comment') {
                return $attributes;
            }

            if (!Str::contains($post->content, ['[embed-video'])) {
                return $attributes;
            }

            if (!$serializer->getActor()->can('nearata.embedvideo.view')) {
                $attributes['nearataEmbedVideoCanView'] = false;

                $post->content = preg_replace('/url=\'.*?\'/', 'url=\'\'', $post->content);

                $attributes['contentHtml'] = $post->formatContent($this->request);

                if (in_array('content', $attributes)) {
                    $attributes['content'] = $post->content;
                }
            }

            return $attributes;
        }),

    (new Extend\Console())
        ->command(PurgeCommand::class)
];
