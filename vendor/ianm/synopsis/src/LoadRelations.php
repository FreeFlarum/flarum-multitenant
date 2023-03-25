<?php

/*
 * This file is part of ianm/synopsis.
 *
 * (c) 2020 - 2022 Ian Morland
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IanM\Synopsis;

use Flarum\Api\Controller\AbstractSerializeController;
use Flarum\Settings\SettingsRepositoryInterface;

class LoadRelations
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(AbstractSerializeController $controller)
    {
        // Only include the `lastPost` relation if we need it.
        if ($this->settings->get('ianm-synopsis.excerpt-type') === 'last') {
            $controller->addInclude('lastPost');
        } else {
            $controller->addInclude('firstPost');
        }
    }
}
