<?php

/*
 * This file is part of fof/cookie-consent.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\CookieConsent\Listeners;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Settings\SettingsRepositoryInterface;

class LoadSettingsFromDatabase
{
    /**
     * @var string
     */
    protected $packagePrefix = 'fof-cookie-consent.';
    /**
     * @var array
     */
    protected $fieldsToGet = [
        'consentText',
        'buttonText',
        'learnMoreLinkText',
        'learnMoreLinkUrl',
        'backgroundColor',
        'textColor',
        'buttonBackgroundColor',
        'buttonTextColor',
        'ccTheme',
    ];

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * LoadSettingsFromDatabase constructor.
     *
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(ForumSerializer $serializer): array
    {
        $attributes = [];

        foreach ($this->fieldsToGet as $field) {
            $value = $this->settings->get($this->packagePrefix.$field);

            if (isset($value) && !empty($value)) {
                $attributes[$this->packagePrefix.$field] = $this->settings->get($this->packagePrefix.$field);
            }
        }

        return $attributes;
    }
}
