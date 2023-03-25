<?php

/*
 * This file is part of ralkage/flarum-hcaptcha.
 *
 * Copyright (c) 2021 Christian Lopez.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ralkage\HCaptcha\Content;

use Flarum\Frontend\Document;
use Flarum\Settings\SettingsRepositoryInterface;

class ExtensionSettings
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    protected $prefix = 'ralkage-hcaptcha.';

    protected $keys = ['credentials.site', 'type'];

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(Document $document)
    {
        foreach ($this->keys as $key) {
            $document->payload[$this->prefix.$key] = $this->settings->get($this->prefix.$key);
        }
    }
}
