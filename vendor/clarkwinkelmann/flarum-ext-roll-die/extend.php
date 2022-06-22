<?php

namespace ClarkWinkelmann\RollDie;

use Flarum\Api\Serializer\PostSerializer;
use Flarum\Extend;
use Flarum\Post\Event\Saving;
use Flarum\Post\Post;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Support\Arr;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/less/forum.less')
        ->js(__DIR__ . '/js/dist/forum.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\Event())
        ->listen(Saving::class, function (Saving $event) {
            $attributes = Arr::get($event->data, 'attributes', []);

            if (!Arr::exists($attributes, 'content')) {
                return;
            }

            /**
             * @var $settings SettingsRepositoryInterface
             */
            $settings = resolve(SettingsRepositoryInterface::class);

            $rolls = [];

            if ($event->post->dice_rolls && !$settings->get('roll-die.clearOnEdit')) {
                $rolls = str_split($event->post->dice_rolls);
            }

            // We don't actually care about permission to edit post content
            // If the user isn't allowed or the content is invalid, the save will fail anyway
            // and the values generated here will never be persisted to the database
            // Negative lookahead is necessary to match multiple emojis immediately following each other
            // Allow die in block quotes, because it's just too difficult to exclude this in the HTML parsing in the frontend
            preg_match_all('~(?:[\n\r]|^)(>\s*)?(🎲|⚀|⚁|⚂|⚃|⚄|⚅)(?=[\n\r]|$)~', Arr::get($attributes, 'content'), $matches);

            $numberOfRolls = count($matches[0]);

            // We only generate additional numbers
            // Even if some of the dice have been edited out, we keep the value in case they are added back in
            for ($i = count($rolls); $i < $numberOfRolls; $i++) {
                $rolls[] = (string)random_int(1, 6);
            }

            // The rolls are saved as characters in a single string
            $event->post->dice_rolls = implode('', $rolls);
        }),

    (new Extend\ApiSerializer(PostSerializer::class))
        ->attributes(function (PostSerializer $serializer, Post $post): array {
            if ($post->dice_rolls) {
                return [
                    'diceRolls' => $post->dice_rolls,
                ];
            }

            return [];
        }),
];
