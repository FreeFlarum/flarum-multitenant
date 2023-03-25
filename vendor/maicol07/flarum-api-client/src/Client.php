<?php

namespace Maicol07\Flarum\Api;

use Illuminate\Cache\ArrayStore;
use Illuminate\Support\Arr;
use Maicol07\Flarum\Api\Response\Factory;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package Maicol07\Client\Api
 * @mixin Fluent
 */
class Client
{
    /** @var Cache */
    protected static $cache;
    /** @var \GuzzleHttp\Client */
    protected $client;
    /** @var Fluent */
    protected $fluent;
    /** @var bool Whether to enforce specific markup/variables setting. */
    protected $authorized = false;
    /** @var bool */
    protected $strict = true;

    /**
     * Client constructor.
     *
     * @param string $host Full FQDN hostname to your Flarum forum, eg http://example.com/forum
     * @param array $authorization Holding either "token" or "username" and "password" as keys.
     * @param array $options Custom options for the HTTP Client
     */
    public function __construct(string $host, array $authorization = [], array $options = [])
    {
        $this->client = new \GuzzleHttp\Client(array_merge([
            'base_uri' => "$host/api/",
            'headers' => $this->getHeaders($authorization)
        ], $options));

        $this->fluent = new Fluent($this);

        static::$cache = new Cache(new ArrayStore);
    }

    /**
     * Request to Flarum the specified resource
     *
     * @return bool|Resource\Collection|Resource\Item|null
     *
     * @noinspection PhpInconsistentReturnPointsInspection
     * @noinspection MissingReturnTypeInspection
     */
    public function request()
    {
        $method = $this->fluent->getMethod();

        $options = $this->getVariablesForMethod();

        $additional_headers = $this->fluent->getHeaders();
        if (!empty($additional_headers)) {
            $headers = array_merge($this->client->getConfig('headers'), $additional_headers);
            $options = array_merge($options, ['headers' => $headers]);
        }

        try {
            $response = $this->client->{$method}((string)$this->fluent, $options);
            assert($response instanceof ResponseInterface);
        } finally {
            // Reset the fluent builder for a new request.
            $this->fluent->reset();
        }

        /** @noinspection NotOptimalIfConditionsInspection */
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return Factory::build($response);
        }
    }

    /**
     * Get request headers
     *
     * @param array $authorization
     *
     * @return string[]
     */
    protected function getHeaders(array $authorization = []): array
    {
        $headers = [
            'Accept' => 'application/vnd.api+json, application/json',
            'User-Agent' => 'Maicol07 Flarum Api Client'
        ];

        $token = Arr::get($authorization, 'token');

        if ($token) {
            $this->authorized = true;
            Arr::set($headers, 'Authorization', "Token $token; userId=1");
        }

        return $headers;
    }

    /**
     * Get the cache object
     *
     * @return Cache
     */
    public static function getCache(): Cache
    {
        return self::$cache;
    }

    /**
     * Get body variables
     *
     * @return array|array[]
     */
    protected function getVariablesForMethod(): array
    {
        $variables = $this->fluent->getVariables();

        if (empty($variables)) {
            return [];
        }

        if ($this->fluent->getMethod() === 'get') {
            return $variables;
        }

        return in_array($this->fluent->getType(), $this->fluent->typesWithoutJsonApi, true) ? [
            'json' => $variables
        ] : [
            'json' => ['data' => $variables]
        ];
    }

    /**
     * @param string $name
     * @param mixed $arguments
     * @return false|mixed
     *
     * @noinspection MissingReturnTypeInspection
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    public function __call(string $name, $arguments)
    {
        return call_user_func_array([$this->fluent, $name], $arguments);
    }

    public function getFluent(): Fluent
    {
        return $this->fluent;
    }

    public function getClient(): \GuzzleHttp\Client
    {
        return $this->client;
    }


    public function isStrict(): bool
    {
        return $this->strict;
    }

    public function setStrict(bool $strict): Client
    {
        $this->strict = $strict;
        return $this;
    }

    /**.
     * Checks if user is authorized (an authorization header with the api token exists)
     *
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->authorized;
    }
}
