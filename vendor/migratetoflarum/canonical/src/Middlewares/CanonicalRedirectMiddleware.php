<?php

namespace MigrateToFlarum\Canonical\Middlewares;

use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Uri;

class CanonicalRedirectMiddleware implements Middleware
{
    public function process(Request $request, Handler $handler): Response
    {
        /**
         * @var $settings SettingsRepositoryInterface
         */
        $settings = app(SettingsRepositoryInterface::class);

        $status = intval($settings->get('migratetoflarum-canonical.status'));

        if ($status === 301 || $status === 302) {
            /**
             * @var $generator UrlGenerator
             */
            $generator = app(UrlGenerator::class);
            $canonical = new Uri($generator->to('forum')->base());

            $uri = $request->getUri();

            // First we redirect the current host to the canonical scheme (hopefully HTTPS)
            // so that HSTS can be applied to that domain
            if ($uri->getScheme() !== $canonical->getScheme()) {
                return new RedirectResponse($uri->withScheme($canonical->getScheme()), $status);
            }

            // Once we're on the expected scheme, redirect to the correct hostname
            if ($uri->getHost() !== $canonical->getHost()) {
                return new RedirectResponse($uri->withHost($canonical->getHost()), $status);
            }
        }

        return $handler->handle($request);
    }
}
