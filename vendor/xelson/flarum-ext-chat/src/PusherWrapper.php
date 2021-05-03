<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat;

use Flarum\Settings\SettingsRepositoryInterface;
use Pusher\Pusher;
use Pusher as PusherLegacy;

class PusherWrapper
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var Pusher
     */
    protected $pusher;

    /**
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return bool|\Illuminate\Foundation\Application|mixed|Pusher
     * @throws \Pusher\PusherException
     */
    private function buildPusher()
    {
        if (class_exists(Pusher::class) && resolve()->bound(Pusher::class)) return resolve(Pusher::class);
        else if (class_exists(PusherLegacy::class)) {
            $settings = resolve('flarum.settings');

            $options = [];

            if ($cluster = $settings->get('flarum-pusher.app_cluster')) {
                $options['cluster'] = $cluster;
            }

            return new PusherLegacy(
                $settings->get('flarum-pusher.app_key'),
                $settings->get('flarum-pusher.app_secret'),
                $settings->get('flarum-pusher.app_id'),
                $options
            );
        } else {
            return false;
        }
    }

    /**
     * Pseudo for pusher instance
     * 
     * @return Pusher
     */
    public function pusher()
    {
        if (is_null($this->pusher)) {
            $this->pusher = $this->buildPusher();
        }

        return $this->pusher;
    }
}
