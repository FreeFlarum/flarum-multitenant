<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\StopForumSpam;

use Flarum\Settings\SettingsRepositoryInterface;
use FoF\StopForumSpam\Events\RegistrationBlocked;
use GuzzleHttp\Client;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

class StopForumSpam
{
    private const KEY = 'fof-stopforumspam.api_key';

    protected $endpoints = [
        'closest' => 'https://api.stopforumspam.org/',
        'europe'  => 'https://europe.stopforumspam.org/',
        'us'      => 'https://us.stopforumspam.org/',
    ];

    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Dispatcher
     */
    private $bus;

    public function __construct(SettingsRepositoryInterface $settings, Dispatcher $bus)
    {
        $this->settings = $settings;
        $this->bus = $bus;

        $this->client = new Client([
            'base_uri' => $this->endpoint(),
            'verify'   => false,
        ]);
    }

    private function endpoint(): string
    {
        return $this->endpoints[empty($choice = $this->settings->get('fof-stopforumspam.regionalEndpoint')) ? 'closest' : $choice];
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

    private function call(string $url, array $data): ResponseInterface
    {
        return $this->client->post($url, [
            'form_params' => $data,
        ]);
    }

    /**
     * Consumes an array containing `ip`, `email` and `username` and validates against the StopForumSpam API.
     * Returns a simple boolean indicating if based on the current extension settings this registration
     * should be prevented or not.
     *
     * @param array $data
     *
     * @return bool
     */
    public function shouldPreventLogin(array $data, ?string $provider = null, ?array $providerData = null): bool
    {
        $data['json'] = 1;

        $hashEmail = (bool) $this->settings->get('fof-stopforumspam.emailhash', false);

        if ($hashEmail) {
            $data['emailhash'] = md5($data['email']);
            Arr::pull($data, 'email');
        }

        $response = $this->call('api', $data);
        $body = json_decode($response->getBody());

        if ($body->success === 1) {
            unset($body->success);

            $requiredFrequency = (int) empty($this->settings->get('fof-stopforumspam.frequency')) ? 5 : $this->settings->get('fof-stopforumspam.frequency');
            $requiredConfidence = (float) empty($this->settings->get('fof-stopforumspam.confidence')) ? 50 : $this->settings->get('fof-stopforumspam.confidence');
            $frequency = 0;
            $confidence = 0.0;

            foreach ($body as $key => $value) {
                if ((int) $this->settings->get("fof-stopforumspam.$key")) {
                    if (isset($value->frequency)) {
                        $frequency += $value->frequency;
                    }

                    if (isset($value->confidence)) {
                        $confidence += $value->confidence;
                    }
                }
            }

            if ($confidence >= $requiredConfidence || $frequency >= $requiredFrequency) {
                $this->bus->dispatch(new RegistrationBlocked(
                    Arr::get($data, 'username', 'unknown'),
                    Arr::get($data, 'ip', 'unknown'),
                    Arr::get($data, 'email', 'unknown'),
                    $data,
                    $provider,
                    $providerData
                ));

                return true;
            }
        }

        return false;
    }
}
