<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\StopForumSpam;

use Flarum\Settings\SettingsRepositoryInterface;
use GuzzleHttp\Client as Guzzle;
use Psr\Http\Message\ResponseInterface;

class StopForumSpam
{
    private const KEY = 'fof-stopforumspam.api_key';

    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function isEnabled(): bool
    {
        $key = $this->settings->get(self::KEY);

        return $key != null && !empty($key);
    }

    public function report(array $data): ResponseInterface
    {
        $data['api_key'] = $this->settings->get(self::KEY);

        return $this->call('https://www.stopforumspam.com/add', $data);
    }

    public function check(array $data)
    {
        $data['json'] = 1;

        $response = $this->call('https://api.stopforumspam.com/api', $data);

        return json_decode($response->getBody());
    }

    private function call(string $url, array $data): ResponseInterface
    {
        $client = new Guzzle();

        return $client->post($url, [
            'form_params' => $data,
            'verify'      => false,
        ]);
    }
}
