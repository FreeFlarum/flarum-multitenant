<?php

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var SettingsRepositoryInterface
         */
        $settings = app('flarum.settings');

        $keys = ['mailhtml', 'newPost', 'postMentioned', 'userMentioned', 'includeCSS'];

        foreach ($keys as $key) {
            $value = $settings->get($full = "reflar-pretty-mail.$key");

            if ($value) {
                $settings->set("fof-pretty-mail.$key", $value);
                $settings->delete($full);
            } else {
                if ($key === 'includeCSS') {
                    continue;
                }

                $settings->set("fof-pretty-mail.$key", file_get_contents(__DIR__."/../resources/defaults/$key.blade.php"));
            }
        }
    },
    'down' => function (Builder $schema) {
        //
    },
];
