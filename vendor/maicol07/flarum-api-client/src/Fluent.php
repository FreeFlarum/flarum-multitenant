<?php

namespace Maicol07\Flarum\Api;

use Illuminate\Support\Arr;
use Maicol07\Flarum\Api\Exceptions\UnauthorizedRequestMethodException;

/**
 * Class Fluent
 * @package Maicol07\Client\Api
 *
 * @method Fluent token() Set the token endpoint
 * @method Fluent discussions(int|null $id = null) Set the discussions endpoint and optionally filter the results providing a discussion ID
 * @method Fluent posts(int|null $id = null) Set the posts endpoint and optionally filter the results providing a discussion ID
 * @method Fluent users(string|int|null $id = null) Set the users endpoint and optionally filter the results providing a user ID or username
 * @method Fluent groups(int|null $id = null) Set the groups endpoint and optionally filter the results providing a group ID
 * @method Fluent notifications(int|null $id = null) Set the notifications endpoint. Only pass the notification ID if you are using the PATCH method
 * @method Fluent tags(int|null $id = null) Set the tags endpoint and optionally filter the results providing a tag ID
 *
 * @method Fluent get() Set the GET request method
 * @method Fluent page(int $page = 0) Set the page to request in the current GET request
 * @method Fluent head() Set the HEAD request method
 * @method Fluent post(array $variables = []) Set the POST request method and optionally send a JSON body, written as an array
 * @method Fluent put(array $variables = []) Set the PUT request method and optionally send a JSON body, written as an array
 * @method Fluent patch(array $variables = []) Set the PATCH request method and optionally send a JSON body, written as an array
 * @method Fluent delete() Set the DELETE request method and optionally send a JSON body, written as an array
 *
 * @method bool|Resource\Collection|Resource\Item|null|Resource\Token request() Execute the request. If called without any endpoint and / or methods ( or GET), it returns Flarum info
 */
class Fluent
{
    /** @var array */
    protected $types = [
        'token',
        'discussions',
        'posts',
        'users',
        'groups',
        'notifications',
        'tags',
    ];

    /** @var array */
    protected $methods = [
        'get', 'head',
        'post', 'put', 'patch',
        'delete'
    ];

    /** @var array */
    protected $methodsRequiringAuthorization = [
        'post', 'put', 'patch', 'delete'
    ];

    /** @var array */
    protected $additional_headers = [];

    /** @var string[] */
    public $typesWithoutJsonApi = [
        'token'
    ];

    /** @var array */
    protected $pagination = [
        'page'
    ];

    /** @var array */
    protected $segments = [];

    /** @var array */
    protected $query = [];

    /** @var array */
    protected $includes = [];

    /** @var Client */
    protected $client;

    /** @var string */
    protected $method = 'get';

    /** @var array */
    protected $variables = [];

    public function __construct(Client $flarum)
    {
        $this->client = $flarum;
    }

    /**
     * Resets request data (segments (path), includes, query parameters, variables (json body), method)
     *
     * @return $this
     */
    public function reset(): Fluent
    {
        $this->segments = [];
        $this->includes = [];
        $this->query = [];
        $this->variables = [];
        $this->method = 'get';

        return $this;
    }

    /**
     * Handle request type
     *
     * @param string $type
     * @param string|int $id If $type is user and ID is a string, it will be used as username. To use an ID, use an int
     *
     * @return $this
     *
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    protected function handleType(string $type, $id): Fluent
    {
        $this->segments[] = $type;

        if ($id) {
            $this->segments[] = $id;
            if ($type === 'users' && is_string($id)) {
                $this->addQueryParameter('bySlug', true);
            }
        }

        return $this;
    }

    /**
     * Set API endpoint (for non-regular requests)
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): Fluent
    {
        $this->segments = [$path];

        return $this;
    }

    /**
     * Set a request method
     *
     * @param string $method
     *
     * @return Fluent
     *
     * @throws UnauthorizedRequestMethodException
     */
    public function setMethod(string $method): Fluent
    {
        $this->method = strtolower($method);

        if (
            $this->client->isStrict() &&
            !$this->client->isAuthorized() &&
            in_array($this->method, $this->methodsRequiringAuthorization, true)) {
            throw new UnauthorizedRequestMethodException($this->method);
        }

        return $this;
    }

    /**
     * Set request variables (json body)
     *
     * @param array $variables
     * @return $this
     */
    public function setVariables(array $variables = []): Fluent
    {
        if (isset($variables['relationships'])) {
            foreach ($variables['relationships'] as $relation => $relationship) {
                if (!Arr::get($relationship, 'data')) {
                    unset($variables['relationships'][$relation]);
                    $variables['relationships'][$relation]['data'] = $relationship;
                }
            }
        }

        if (count($variables) === 1 && is_array($variables[0])) {
            $this->variables = $variables[0];
        } else {
            $this->variables = $variables;
        }

        return $this;
    }

    /**
     * Add query parameters to the request
     *
     * @param string $type Query parameter key
     * @param mixed $value Query parameter value
     *
     * @return $this
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    public function addQueryParameter(string $type, $value): Fluent
    {
        $this->query[$type] = $value;

        return $this;
    }

    /**
     * Add resource ID.
     * @param string|int $id
     *
     * @return $this
     * @see handleType() for ID data type explanation for the user endpoint.
     *
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    public function id($id): Fluent
    {
        $this->segments[] = $id;

        return $this;
    }

    /**
     * Add include query parameter to the request
     *
     * @param string $include
     *
     * @return $this
     */
    public function include(string $include): Fluent
    {
        $this->includes[] = $include;

        return $this;
    }

    /**
     * Set the page offset of the current GET request
     *
     * @param int $number
     * @return Fluent
     */
    public function offset(int $number): Fluent
    {
        return $this->addQueryParameter('page[offset]', $number);
    }

    /**
     * Add a filter to the current GET request
     *
     * @param array $filters
     * @return Fluent
     */
    public function filter(array $filters = []): Fluent
    {
        foreach ($filters as $filter => $value) {
            $this->addQueryParameter("filter[$filter]", $value);
        }
        return $this;
    }

    /**
     * Add additional headers
     *
     * @param array $headers
     *
     * @return $this
     */
    public function header(array $headers): Fluent
    {
        $this->additional_headers = array_merge($this->additional_headers, $headers);
        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getType(): string
    {
        return $this->segments[0];
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function getHeaders(): array
    {
        return $this->additional_headers;
    }

    /**
     * Returns request path
     *
     * @return string
     */
    public function __toString(): string
    {
        $path = implode('/', $this->segments);

        if ($this->includes || $this->query) {
            $path .= '?';
        }

        if ($this->includes) {
            $path .= sprintf(
                'include=%s&',
                implode(',', $this->includes)
            );
        }

        if ($this->query) {
            $path .= http_build_query($this->query);
        }

        return $path;
    }

    /**
     * @param string $name
     * @param mixed $arguments
     * @return Fluent|void|mixed
     *
     * @throws UnauthorizedRequestMethodException
     *
     * @noinspection MissingReturnTypeInspection
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    public function __call(string $name, $arguments)
    {
        if (in_array($name, $this->methods, true)) {
            if (!empty($arguments)) {
                $this->setVariables($arguments);
            }
            return $this->setMethod($name);
        }

        if (count($arguments) <= 1 && in_array($name, $this->types, true)) {
            return $this->handleType($name, $arguments[0] ?? null);
        }

        if (in_array($name, $this->pagination, true) && count($arguments) === 1) {
            return call_user_func_array([$this, 'addQueryParameter'], Arr::prepend($arguments, $name));
        }

        if (method_exists($this->client, $name)) {
            return call_user_func_array([$this->client, $name], $arguments);
        }
    }
}
