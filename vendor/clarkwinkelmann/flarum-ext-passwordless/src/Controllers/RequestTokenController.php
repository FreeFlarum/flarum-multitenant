<?php

namespace ClarkWinkelmann\PasswordLess\Controllers;

use Carbon\Carbon;
use ClarkWinkelmann\PasswordLess\Token;
use Flarum\Foundation\ValidationException;
use Flarum\Http\UrlGenerator;
use Flarum\Locale\Translator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Exception\NotAuthenticatedException;
use Flarum\User\User;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestTokenController implements RequestHandlerInterface
{
    protected $validatorFactory;
    protected $translator;
    protected $settings;
    protected $mailer;
    protected $url;

    public function __construct(Factory $validatorFactory, Translator $translator, SettingsRepositoryInterface $settings, Mailer $mailer, UrlGenerator $url)
    {
        $this->validatorFactory = $validatorFactory;
        $this->translator = $translator;
        $this->settings = $settings;
        $this->mailer = $mailer;
        $this->url = $url;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $this->validatorFactory->make(Arr::only($body, 'identification'), [
            'identification' => 'required|email',
        ])->validate();

        $identification = Arr::get($body, 'identification');
        $remember = (bool)Arr::get($body, 'remember');

        $user = User::query()->where('email', $identification)->first();

        if (!$user) {
            throw new NotAuthenticatedException();
        }

        if (Token::query()->where('user_id', $user->id)->where('created_at', '>', Carbon::now()->subSeconds(30))->exists()) {
            throw new ValidationException([
                'password' => $this->translator->trans('clarkwinkelmann-passwordless.api.request-throttle-error'),
            ]);
        }

        $expireMinutes = $this->settings->get('passwordless.tokenLifeInMinutes') ?: 5;

        $token = Token::generate($user->id, $remember, $expireMinutes);
        $token->save();

        $this->mailer->send('passwordless::mail', [
            'link' => $this->url->to('forum')->route('clarkwinkelmann.passwordless') . '?user=' . $user->id . '&token=' . $token->token,
            'token' => $token->token,
            'expireMinutes' => $expireMinutes,
        ], function (Message $message) use ($user) {
            $message->to($user->email);
            $message->subject($this->translator->trans('clarkwinkelmann-passwordless.mail.subject', [
                '{title}' => $this->settings->get('forum_title'),
            ]));
        });

        return new EmptyResponse();
    }
}
