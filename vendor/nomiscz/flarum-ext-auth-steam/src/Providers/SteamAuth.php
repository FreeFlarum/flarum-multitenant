<?php

/*
 * This file is part of nomiscz/flarum-ext-auth-steam.
 *
 * Copyright (c) 2019 NomisCZ.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace NomisCZ\SteamAuth\Providers;

use Exception;
use Illuminate\Support\Fluent;
use Flarum\Settings\SettingsRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Client as GuzzleClient;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Uri;

/**
 * Class SteamAuth
 * @package NomisCZ\SteamAuth
 * @author NomisCZ | Original: Nikita Brytkov (invisnik)
 */
class SteamAuth implements SteamAuthInterface
{
    /**
     * @var array
     */
    const OPENID_DOMAINS = [
        'steamcommunity.com',
        'steampowered.com'
    ];
    /**
     * @var string
     */
    const OPENID_URL = 'https://{DOMAIN}/openid';
    /**
     * @var string
     */
    const STEAM_INFO_URL = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s';
    /**
     * @var string
     */
    const OPENID_SIG = 'openid_sig';
    /**
     * @var string
     */
    const OPENID_SIGNED = 'openid_signed';
    /**
     * @var string
     */
    const OPENID_ASSOC_HANDLE = 'openid_assoc_handle';
    /**
     * @var string
     */
    const OPENID_NS = 'http://specs.openid.net/auth/2.0';

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $authUrl;

    /**
     * @var int|null
     */
    private $steamId;

    /**
     * @var Fluent|null
     */
    private $steamInfo;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var bool
     */
    private $useSteamPoweredDomain;

    /**
     * SteamAuth constructor.
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
        $this->guzzleClient = new GuzzleClient;
        $this->apiKey = $this->settings->get('flarum-ext-auth-steam.api_key');
        $this->useSteamPoweredDomain = $this->settings->get('flarum-ext-auth-steam.use_steam_powered_domain') == 1;
    }

    /**
     * Set request
     * @param Request $request
     */
    public function setRequest(Request $request) : void
    {
        $this->request = $request;
        $this->authUrl = $this->buildUrl();
    }

    /**
     * Check the Steam login
     * @return bool
     * @throws Exception
     */
    public function validate() : bool
    {
        if (!$this->request) {
            throw new Exception("Missing request, please use setRequest to specify it.");
        }

        if (!$this->requestIsValid()) {
            return false;
        }

        $requestOptions = $this->getDefaultRequestOptions();
        $response = $this->guzzleClient->request('POST', $this->getOpenIdUrl().'/login', $requestOptions);

        $this->parseSteamID();
        $this->parseInfo();

        return $response->getStatusCode() === 200;
    }

    /**
     * Parse OpenID response to Fluent object
     * @param $results
     * @return Fluent
     */
    public function parseResults($results) : Fluent
    {
        $parsed = [];
        $lines = explode("\n", $results);

        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }

            $line = explode(':', $line, 2);
            $parsed[$line[0]] = $line[1];
        }

        return new Fluent($parsed);
    }

    /**
     * Return the redirect response to login
     * @return RedirectResponse
     */
    public function redirect() : RedirectResponse
    {
        return new RedirectResponse($this->authUrl);
    }

    /**
     * Returns the Steam User info
     * @return Fluent
     */
    public function getUserInfo() : Fluent
    {
        return $this->steamInfo;
    }

    /**
     * Returns the Steam Id
     * @return string
     */
    public function getSteamId() : string
    {
        return $this->steamId;
    }

    /**
     * Get param list for OpenID validation
     * @return array
     */
    private function getParams()
    {
        $queryParams = $this->request->getQueryParams();

        $params = [
            'openid.assoc_handle' => array_get($queryParams,self::OPENID_ASSOC_HANDLE),
            'openid.signed'       => array_get($queryParams,self::OPENID_SIGNED),
            'openid.sig'          => array_get($queryParams,self::OPENID_SIG),
            'openid.ns'           => self::OPENID_NS,
            'openid.mode'         => 'check_authentication',
        ];

        $signedParams = explode(',', array_get($queryParams,self::OPENID_SIGNED));

        foreach ($signedParams as $item) {
            $value = array_get($queryParams,'openid_'.str_replace('.', '_', $item));
            $params['openid.'.$item] = $value;
        }

        return $params;
    }

    /**
     * Validates if the request object has required stream attributes
     * @return bool
     */
    private function requestIsValid() : bool
    {
        $queryParams = $this->request->getQueryParams();

        return array_has($queryParams,self::OPENID_ASSOC_HANDLE)
            && array_has($queryParams,self::OPENID_SIGNED)
            && array_has($queryParams,self::OPENID_SIG);
    }

    /**
     * Build the Steam login URL.
     * @return string
     */
    private function buildUrl() : string
    {
        $redirectUri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $params = http_build_query([
            'openid.ns'         => self::OPENID_NS,
            'openid.mode'       => 'checkid_setup',
            'openid.return_to'  => (string) $redirectUri,
            'openid.realm'      => (string) $redirectUri,
            'openid.identity'   => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
        ]);

        return (string) (new Uri($this->getOpenIdUrl().'/login'))->withQuery($params);
    }

    /**
     * @return array
     */
    private function getDefaultRequestOptions() : array
    {
        return [
            'form_params' => $this->getParams(),
        ];
    }

    /**
     *  Parse the steamID from the OpenID response
     */
    private function parseSteamID() : void
    {
        $queryParams = $this->request->getQueryParams();
        preg_match('#^https?://'.$this->getOpenIdUrl(false).'/id/([0-9]{17,25})#', array_get($queryParams,'openid_claimed_id'), $matches);
        $this->steamId = is_numeric($matches[1]) ? $matches[1] : 0;
    }

    /**
     * Get user data from Steam API
     * @throws Exception
     */
    private function parseInfo() : void
    {
        if (!$this->steamId) {
            return;
        }

        if (!$this->apiKey) {
            throw new Exception("The Steam API key is missing, please set it in administration.");
        }

        $response = $this->guzzleClient->request('GET', sprintf(self::STEAM_INFO_URL, $this->apiKey, $this->steamId));
        $jsonResponse = json_decode($response->getBody(), true);
        $this->steamInfo = new Fluent($jsonResponse['response']['players'][0]);
    }

    /**
     * Get OpenID API URL depending on setting value (
     * @param bool $withProtocol
     * @return string
     */
    private function getOpenIdUrl($withProtocol = true) : string
    {
       return str_replace($withProtocol ? '{DOMAIN}' : 'https://{DOMAIN}', $this->getOpenIdDomain(), self::OPENID_URL);
    }

    /**
     * Get OpenID API DOMAIN depending on setting value
     */
    private function getOpenIdDomain() : string
    {
        return self::OPENID_DOMAINS[$this->useSteamPoweredDomain];
    }
}
