<?php

namespace ClarkWinkelmann\PasswordLess\Controllers;

use ClarkWinkelmann\PasswordLess\Token;
use Flarum\Foundation\Config;
use Flarum\Foundation\DispatchEventsTrait;
use Flarum\Http\RememberAccessToken;
use Flarum\Http\Rememberer;
use Flarum\Http\SessionAccessToken;
use Flarum\Http\SessionAuthenticator;
use Flarum\Locale\Translator;
use Flarum\User\Event\LoggedIn;
use Flarum\User\User;
use Flarum\User\UserRepository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginFromTokenController implements RequestHandlerInterface
{
    use DispatchEventsTrait;

    protected $config;
    protected $users;
    protected $authenticator;
    protected $rememberer;
    protected $viewFactory;
    protected $translator;

    public function __construct(Dispatcher $events, Config $config, UserRepository $users, SessionAuthenticator $authenticator, Rememberer $rememberer, Factory $viewFactory, Translator $translator)
    {
        $this->events = $events;
        $this->config = $config;
        $this->users = $users;
        $this->authenticator = $authenticator;
        $this->rememberer = $rememberer;
        $this->viewFactory = $viewFactory;
        $this->translator = $translator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();

        $url = Arr::get($params, 'return', $this->config->url());
        $response = new RedirectResponse($url);

        /**
         * @var User $actor
         */
        $actor = $request->getAttribute('actor');

        // If the user is already logged in, redirect as if login was successful
        if (!$actor->isGuest()) {
            return $response;
        }

        $userId = Arr::get($params, 'user');
        $passwordlessTokenValue = Arr::get($params, 'token');

        /**
         * @var Token $passwordlessToken
         */
        $passwordlessToken = Token::query()->where('user_id', $userId)->where('token', $passwordlessTokenValue)->first();

        if (!$passwordlessToken || $passwordlessToken->isExpired()) {
            // Show the Flarum error view, but with our custom message
            $view = $this->viewFactory->make('flarum.forum::error.not_found')
                ->with('message', $this->translator->trans('clarkwinkelmann-passwordless.api.' . ($passwordlessToken ? 'expired' : 'invalid') . '-token-error'));

            return new HtmlResponse($view->render(), 404);
        }

        Token::deleteOldTokens();

        $accessToken = $passwordlessToken->remember ? RememberAccessToken::generate($passwordlessToken->user_id) : SessionAccessToken::generate($passwordlessToken->user_id);

        /**
         * @var Session $session
         */
        $session = $request->getAttribute('session');

        $this->authenticator->logIn($session, $accessToken);

        $user = $this->users->findOrFail($accessToken->user_id);

        // Validate the user just like if they used an email confirmation token
        // We only do this when you use the link and not type the token as password
        // because it's too complicated to do it in the password check
        $user->activate();
        $user->save();
        $this->dispatchEventsFor($user);

        $this->events->dispatch(new LoggedIn($user, $accessToken));

        if ($accessToken instanceof RememberAccessToken) {
            $response = $this->rememberer->remember($response, $accessToken);
        }

        return $response;
    }
}
