<?php

namespace ClarkWinkelmann\Status\Listeners;

use ClarkWinkelmann\Status\Validators\EmojiValidator;
use ClarkWinkelmann\Status\Validators\TextValidator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class SaveStatus
{
    public function handle(Saving $event)
    {
        $attributes = Arr::get($event->data, 'attributes', []);

        if (array_key_exists('clarkwinkelmannStatusEmoji', $attributes)) {
            $event->actor->assertCan('clarkwinkelmannStatusEdit', $event->user);

            /**
             * @var $settings SettingsRepositoryInterface
             */
            $settings = resolve(SettingsRepositoryInterface::class);

            $emoji = $attributes['clarkwinkelmannStatusEmoji'];

            /**
             * @var $validator EmojiValidator
             */
            $validator = resolve(EmojiValidator::class);

            if ($settings->get('clarkwinkelmann-status.onlyCountries')) {
                $validator->onlyFlags();
            }

            $validator->assertValid([
                'emoji' => $emoji,
            ]);

            $event->user->clarkwinkelmann_status_emoji = $emoji;

            if ($settings->get('clarkwinkelmann-status.enableText')) {
                $text = Arr::get($attributes, 'clarkwinkelmannStatusText');

                /**
                 * @var $validator TextValidator
                 */
                $validator = resolve(TextValidator::class);
                $validator->assertValid([
                    'text' => $text,
                ]);

                $event->user->clarkwinkelmann_status_text = $text;
            }
        }
    }
}
