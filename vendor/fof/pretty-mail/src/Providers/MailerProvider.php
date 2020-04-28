<?php

/*
 * This file is part of fof/pretty-mail.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\PrettyMail\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Foundation\Application;
use Flarum\Notification\NotificationMailer;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\EmailConfirmationMailer;
use FoF\PrettyMail\Mailer;
use FoF\PrettyMail\Overrides;

class MailerProvider extends AbstractServiceProvider
{
    public function boot()
    {
        // Mostly copy-pasted from https://github.com/illuminate/mail/blob/v5.1.41/MailServiceProvider.php
        $this->app->singleton('mailer', function (Application $app) {
            $view = $app['view'];

            $mailer = new Mailer($view, $app['swift.mailer'], $app['events']);

            if ($app->bound('queue')) {
                $mailer->setQueue($app['queue']);
            }

            $settings = $app->make(SettingsRepositoryInterface::class);
            $mailer->alwaysFrom($settings->get('mail_from'), $settings->get('forum_title'));

            return $mailer;
        });

        $this->app->extend(NotificationMailer::class, function (NotificationMailer $mailer) {
            return app(Overrides\NotificationMailer::class);
        });

        $this->app->extend(EmailConfirmationMailer::class, function (EmailConfirmationMailer $mailer) {
            return app(Overrides\EmailConfirmationMailer::class);
        });
    }
}
