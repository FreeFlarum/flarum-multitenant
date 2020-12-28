<?php
/* This is part of the jordanjay/flarum-ext-summaries project.
 *
 * Code (c)2019 Jordan Schnaidt
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JordanJay29\Summaries\Listeners;

use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;

class LoadUserSettings
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;
    
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Send the setting on to the frontend
     *
     * @param Serializing $event
     */
    public function handle(Serializing $event)
    {
        if ($event->isSerializer(ForumSerializer::class)) {
            $event->attributes['flarum-ext-summaries.excerpt_length'] = $this->settings->get('flarum-ext-summaries.excerpt_length');
        }
    }
}
