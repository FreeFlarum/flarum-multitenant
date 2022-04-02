<?php

namespace Nearata\TwoFactor\Http\Middleware;

use Flarum\User\Exception\NotAuthenticatedException;
use Flarum\User\UserRepository;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticateWithTwoFactor implements MiddlewareInterface
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getAttribute('routeName') === 'token') {
            return $handler->handle($request);
        }

        $body = $request->getParsedBody();
        $identification = Arr::get($body, 'identification');

        $user = $this->users->findByIdentification($identification);

        if ($user && $user->twofa_active) {
            throw new NotAuthenticatedException;
        }

        return $handler->handle($request);
    }
}
