<?php

/*
 * This file is part of fof/pretty-mail.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace FoF\PrettyMail\Overrides;

use Flarum\Foundation\ContainerUtil;
use Flarum\Foundation\Paths;
use Flarum\Http\UrlGenerator;
use Flarum\Notification\MailableInterface;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use FoF\PrettyMail\BladeCompiler;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use s9e\TextFormatter\Bundles\Fatdown;
use Symfony\Contracts\Translation\TranslatorInterface;

class NotificationMailer extends \Flarum\Notification\NotificationMailer
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * Flarum assets directory, to find out where the css is.
     *
     * @var string
     */
    protected $assets_dir;

    public function __construct(Mailer $mailer, View $view, SettingsRepositoryInterface $settings, TranslatorInterface $translator, UrlGenerator $url, Paths $paths)
    {
        parent::__construct($mailer, $translator, $settings);

        $this->view = $view;
        $this->url = $url;

        $this->assets_dir = $paths->public.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
    }

    /**
     * @param MailableInterface $blueprint
     * @param User              $user
     */
    public function send(MailableInterface $blueprint, User $user)
    {
        $viewName = $blueprint->getEmailView()['text'] ?? null;

        if (!$viewName) {
            parent::send($blueprint, $user);

            return;
        }

        if (Str::startsWith($viewName, 'flarum')) {
            $blade = [];
            preg_match("/\.(.*)$/", $viewName, $blade);

            $template = $this->settings->get("fof-pretty-mail.{$blade[1]}");
        }

        if ((bool) (int) $this->settings->get('fof-pretty-mail.includeCSS')) {
            $file = preg_grep('~^forum-.*\.css$~', scandir($this->assets_dir));
        }

        $data = [
            'user'       => $user,
            'blueprint'  => $blueprint,
            'url'        => $this->url,
            'forumStyle' => isset($file) ? file_get_contents($this->assets_dir.reset($file)) : '',
            'settings'   => $this->settings,
        ];

        foreach (resolve('fof-pretty-mail.additional-data') as $key => $cb) {
            $callback = ContainerUtil::wrapCallback($cb, resolve('container'));
            $data[$key] = $callback($blueprint);
        }

        if (isset($template)) {
            $view = BladeCompiler::render($template, $data);
        } else {
            $body = $this->view->make($viewName, compact('blueprint', 'user'))->render();

            if (strip_tags($body) == $body) {
                $body = Fatdown::render(Fatdown::parse($body));
            }

            $view = BladeCompiler::render($this->settings->get('fof-pretty-mail.mailhtml'), array_merge($data, [
                'body' => $body,
            ]));
        }

        $this->mailer->html(
            $view,
            function (Message $message) use ($blueprint, $user) {
                $message->to($user->email, $user->username)
                    ->subject($blueprint->getEmailSubject($this->translator));
            }
        );
    }
}
