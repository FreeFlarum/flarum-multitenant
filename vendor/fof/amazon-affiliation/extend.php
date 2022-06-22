<?php

/*
 * This file is part of fof/amazon-affiliation.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\AmazonAffiliation;

use Flarum\Extend;
use Flarum\Settings\Event\Saving as SettingsSaving;
use Flarum\Settings\SettingsRepositoryInterface;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Formatter())
        ->render(Formatter\AlterAmazonLinks::class),

    (new Extend\ServiceProvider())
        ->register(Providers\LinkManipulatorProvider::class),

    (new Extend\Event())
        ->listen(SettingsSaving::class, function (SettingsSaving $event) {
            foreach ($event->settings as $key => $setting) {
                if (strpos($key, 'fof-amazon-affiliation.affiliate-tag.') === 0) {
                    resolve('flarum.formatter')->flush();

                    return;
                }
            }
        }),

    (new Extend\Formatter())
        ->configure(function (Configurator $configurator): void {
            /** @var SettingsRepositoryInterface */
            $settings = resolve(SettingsRepositoryInterface::class);
            $prefix = 'fof-amazon-affiliation.affiliate-tag.';

            $params = $configurator->rendering->parameters;
            $params['AMAZON_ASSOCIATE_TAG'] = $settings->get($prefix.'com', '');
            $params['AMAZON_ASSOCIATE_TAG_UK'] = $settings->get($prefix.'co.uk', '');
            $params['AMAZON_ASSOCIATE_TAG_DE'] = $settings->get($prefix.'de', '');
            $params['AMAZON_ASSOCIATE_TAG_FR'] = $settings->get($prefix.'fr', '');
            $params['AMAZON_ASSOCIATE_TAG_JP'] = $settings->get($prefix.'co.jp', '');
            $params['AMAZON_ASSOCIATE_TAG_CA'] = $settings->get($prefix.'ca', '');
            $params['AMAZON_ASSOCIATE_TAG_IT'] = $settings->get($prefix.'it', '');
            $params['AMAZON_ASSOCIATE_TAG_ES'] = $settings->get($prefix.'es', '');
            $params['AMAZON_ASSOCIATE_TAG_IN'] = $settings->get($prefix.'in', '');

            // Not currently supported by MediaEmbed. Will look to PR these into s9e/textformatter soon
            // $params['AMAZON_ASSOCIATE_TAG_CN'] = $settings->get($prefix.'cn', '');
            // $params['AMAZON_ASSOCIATE_TAG_BR'] = $settings->get($prefix.'com.br', '');
            // $params['AMAZON_ASSOCIATE_TAG_MX'] = $settings->get($prefix.'com.mx', '');
            // $params['AMAZON_ASSOCIATE_TAG_AU'] = $settings->get($prefix.'com.au', '');

            extract($configurator->finalize());
        }),
];
