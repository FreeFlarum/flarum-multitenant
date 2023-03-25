<?php /** @noinspection PhpPrivateFieldCanBeLocalVariableInspection @noinspection PhpUndefinedMethodInspection */

namespace Maicol07\SSO;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maicol07\Flarum\Api\Client;
use Maicol07\Flarum\Api\Resource\Item;
use Maicol07\SSO\Traits\Addons;
use Maicol07\SSO\Traits\Cookies;

/**
 * Flarum SSO
 *
 * @author maicol07
 * @package Maicol07\SSO
 */
class Flarum
{
    use Cookies, Addons;

    /* @var Client Api client */
    public $api;

    /* @var bool Should the login be remembered (this equals to 5 years remember from last usage)? If false, token will be remembered only for 1 hour */
    private $remember;

    /* @var string Random token to create passwords */
    public $password_token;

    /* @var string Main site or SSO system domain */
    public $root_domain;

    /* @var string Flarum URL */
    public $url;

    /** @var bool Verify SSL cert. More details on https://docs.guzzlephp.org/en/stable/request-options.html#verify */
    public $verify;

    /** @var string */
    public $cookies_prefix;

    /** @var User|null */
    private $user;

    /**
     * Flarum constructor
     *
     * @param array{
     *     url: string,
     *     root_domain: string,
     *     api_key: string,
     *     password_token: string,
     *     remember: bool,
     *     verify_ssl: bool|string,
     *     cookies_prefix: string
     * } $config Options array. It accepts the following elements:
     *  - url: string - Flarum URL
     *  - root_domain: string - Main site or SSO system domain
     *  - pai_key: string - Random key from the api_keys table of your Flarum forum
     *  - password_token: string - Random token to create passwords
     *  - remember: bool - Should the login be remembered (this equals to 5 years remember from last usage)? If false, token will be remembered only for 1 hour. Default: false
     *  - verify_ssl: bool|string - Verify SSL cert. More details on https://docs.guzzlephp.org/en/stable/request-options.html#verify. Default: true
     *  - cookies_prefix: string - String to prefix the cookie name when creating remember/auth tokens. Default: "flarum"
     */
    public function __construct(array $config)
    {
        // Urls
        $this->url = Arr::get($config, 'url');

        // Fix URL scheme
        if (empty(Arr::get(parse_url($this->url), 'scheme'))) {
            $this->url = 'https://' . $this->url;
        }

        $this->root_domain = Arr::get($config, 'root_domain');
        $url = parse_url($this->root_domain);
        if (!empty(Arr::get($url, 'host'))) {
            $this->root_domain = Arr::get($url, 'host');
        }

        $this->password_token = Arr::get($config, 'password_token');

        $this->verify = Arr::get($config, 'verify_ssl', true);
        $this->api = new Client($this->url, ['token' => Arr::get($config, 'api_key')], [
            'verify' => $this->verify
        ]);

        $this->remember = Arr::get($config, 'remember', false);

        $this->cookies_prefix = Arr::get($config, 'cookies_prefix', 'flarum');

        $this->initAddons();
    }

    /**
     * Logs out the current user from Flarum. Generally, you should use this method when an user successfully logged out from
     * your SSO system (or main website)
     *
     * @return bool
     */
    public function logout(): bool
    {
        $this->action_hook('before_logout');

        $deleted = $this->deleteSessionTokenCookie() and $this->deleteRememberTokenCookie();
        $created = $this->setLogoutCookie();

        $this->hooks->do_action('after_logout', $deleted, $created);

        return ($deleted and $created);
    }

    public function user(string $username = null): User
    {
        if ($this->user === null) {
            $this->user = new User($username, $this);
        }

        return $this->user;
    }


    /**
     * Gets a collection of the users actually signed up on Flarum, with all the properties
     *
     * @param null|string|array $filters Include in the returned collection only the values from filter(s)
     * Can be one or more of the following: type, id, attributes, attributes.username, attributes.displayName,
     * attributes.avatarUrl, attributes.joinTime, attributes.discussionCount, attributes.commentCount,
     * attributes.canEdit, attributes.canDelete, attributes.lastSeenAt, attributes.isEmailConfirmed, attributes.email,
     * attributes.markedAllAsReadAt, attributes.unreadNotificationCount, attributes.newNotificationCount,
     * attributes.preferences, attributes.canSuspend, attributes.bio, attributes.newFlagCount,
     * attributes.canViewRankingPage, attributes.Points, attributes.canPermanentNicknameChange, attributes.canEditPolls,
     * attributes.canStartPolls, attributes.canSelfEditPolls, attributes.canVotePolls, attributes.cover,
     * attributes.cover_thumbnail, relationships, relationships.groups
     *
     * There could be more if you have other extensions that adds them to Flarum API
     *
     * @return Collection
     *
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    public function getUsersList($filters = null): Collection
    {
        $offset = 0;
        $collection = collect();

        while ($offset !== null) {
            $response = $this->api->users()->offset($offset)->request();
            if ($response instanceof Item and empty($response->type)) {
                $offset = null;
                continue;
            }

            $collection = $collection->merge($response->collect()->all());
            $offset = array_key_last($collection->all()) + 1;
        }

        // Filters
        $filtered = collect();
        if (!empty($filters)) {
            $grouped = true;
            if (is_string($filters)) {
                $filters = [$filters];
                $grouped = false;
            }

            foreach ($filters as $filter) {
                $plucked = $collection->pluck($filter);
                if (!empty($grouped)) {
                    $plucked = [$filter => $plucked];
                }
                $filtered = $filtered->mergeRecursive($plucked);
            }
            $collection = $filtered;
        }

        return $collection;
    }

    /**
     * Returns the value of $remember (indicates if login should be remembered)
     *
     * @return bool|void
     *
     * @see $remember
     *
     * @noinspection MissingReturnTypeInspection
     */
    public function isSessionRemembered(bool $remember = null)
    {
        if ($remember !== null) {
            $this->remember = $remember;
            return;
        }
        return $this->remember;
    }

    /**
     * Redirects the user to your Flarum instance
     */
    public function redirect(): void
    {
        header('Location: ' . $this->url);
        die();
    }
}
