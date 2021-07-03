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

namespace FoF\PrettyMail;

use Flarum\Foundation\Paths;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Mail\Mailer as LaravelMailer;
use s9e\TextFormatter\Bundles\Fatdown;
use Swift_Mailer;

class Mailer extends LaravelMailer
{
    /**
     * Flarum assets directory, to find out where the css is.
     *
     * @var string
     */
    protected $assets_dir;

    public function __construct(string $name, Factory $views, Swift_Mailer $swift, Dispatcher $events = null)
    {
        parent::__construct($name, $views, $swift, $events);

        $this->assets_dir = resolve(Paths::class)->public.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
    }

    public function raw($text, $callback, $use_fatdown = true)
    {
        $matches = [];
        preg_match(
            "/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/m",
            $text,
            $matches
        );

        if ($use_fatdown) {
            $body = Fatdown::render(Fatdown::parse($text));
        } else {
            $body = $text;
        }

        /**
         * @var SettingsRepositoryInterface
         */
        $settings = resolve(SettingsRepositoryInterface::class);

        /**
         * @var UrlGenerator
         */
        $url = resolve(UrlGenerator::class);

        if ((bool) (int) $settings->get('fof-pretty-mail.includeCSS')) {
            $file = preg_grep('~^forum-.*\.css$~', scandir($this->assets_dir));
        }

        $view = BladeCompiler::render($settings->get('fof-pretty-mail.mailhtml'), [
            'body'       => $body,
            'settings'   => $settings,
            'url'        => $url,
            'forumStyle' => isset($file) ? file_get_contents($this->assets_dir.reset($file)) : '',
            'link'       => empty($matches) ? null : $matches[0],
        ]);

        $this->html($view, $callback);
    }
}
