<?php

namespace Justoverclock\Contactme\Api\Controller;

use Flarum\Http\RequestUtil;
use Laminas\Diactoros\Response\EmptyResponse;
use Illuminate\Mail\Message;
use Symfony\Contracts\Translation\TranslatorInterface;
use Illuminate\Contracts\Mail\Mailer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Flarum\Settings\SettingsRepositoryInterface;


class ContactController implements RequestHandlerInterface

{
    protected $mailer;
    protected $translator;
    protected $settings;




    public function __construct(Mailer $mailer , TranslatorInterface $translator, SettingsRepositoryInterface $settings)
    {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->settings = $settings;
    }
    public function handle(Request $request): Response
    {
        $actor = $request->getAttribute('actor');
        $actor->assertRegistered();
        $data = $request->getParsedBody();
        $body = $this->translator->trans('flarum-ext-contactme.email.contact.body', ['{username}' => $actor->username, '{email}' => $actor->email, '{message}' => $data['message']]);
        $this->mailer->raw($body, function (Message $message) use($data) {
            $message->to($this->settings->get('justoverclock-contactme.coordinates'));
            $message->subject($this->translator->trans('flarum-ext-contactme.email.contact.subject'));
        });
        return new EmptyResponse();
    }
}
