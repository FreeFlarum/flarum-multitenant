<?php

namespace MigrateToFlarum\Canonical\Middlewares;

use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CanonicalRedirectMiddleware implements MiddlewareInterface
{
    protected $settings;
    protected $url;

    public function __construct(SettingsRepositoryInterface $settings, UrlGenerator $url)
    {
        $this->settings = $settings;
        $this->url = $url;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $status = intval($this->settings->get('migratetoflarum-canonical.status'));

        if ($status === 301 || $status === 302) {
            $canonical = new Uri($this->url->to('forum')->base());

            /**
             * @var $uri Uri
             */
            $uri = $request->getAttribute('originalUri', $request->getUri());

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
