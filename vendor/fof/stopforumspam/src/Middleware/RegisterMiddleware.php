<?php

/*
 * This file is part of fof/stopforumspam.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\StopForumSpam\Middleware;

use Flarum\Foundation\ErrorHandling\JsonApiFormatter;
use Flarum\Foundation\ErrorHandling\Registry;
use Flarum\Foundation\ValidationException;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use FoF\StopForumSpam\StopForumSpam;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RegisterMiddleware implements MiddlewareInterface
{
    /**
     * @var StopForumSpam
     */
    private $sfs;

    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    /**
     * @var UrlGenerator
     */
    private $url;

    public function __construct(StopForumSpam $sfs, SettingsRepositoryInterface $settings, UrlGenerator $url)
    {
        $this->sfs = $sfs;
        $this->settings = $settings;
        $this->url = $url;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $registerUri = new Uri($this->url->to('forum')->path('/register'));
        if ($request->getUri()->getPath() === $registerUri->getPath()) {
            $data = $request->getParsedBody();
            $serverParams = $request->getServerParams();

            if (isset($serverParams['HTTP_CF_CONNECTING_IP'])) {
                $ipAddress = $serverParams['HTTP_CF_CONNECTING_IP'];
            } else {
                $ipAddress = $serverParams['REMOTE_ADDR'];
            }

            $body = null;

            try {
                $body = $this->sfs->check([
                    'ip'       => $ipAddress,
                    'email'    => $data['email'],
                    'username' => $data['username'],
                ]);
            } catch (\Throwable $e) {
                return (new JsonApiFormatter())->format(
                    app(Registry::class)->handle($e),
                    $request
                );
            }

            if ($body->success === 1) {
                unset($body->success);
                $frequency = 0;

                foreach ($body as $key => $value) {
                    if ((int) $this->settings->get("fof-stopforumspam.$key")) {
                        $frequency += $value->frequency;
                    }
                }

                if ($frequency !== 0 && $frequency >= (int) $this->settings->get('fof-stopforumspam.frequency')) {
                    return (new JsonApiFormatter())
                        ->format(
                            app(Registry::class)
                                ->handle(new ValidationException([
                                    'username' => app('translator')->trans('fof-stopforumspam.forum.message.spam'),
                                ])),
                            $request
                        );
                }
            }
        }

        return $handler->handle($request);
    }
}
