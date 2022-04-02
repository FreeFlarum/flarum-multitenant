<?php

namespace FoF\HtmlErrors\ErrorHandling;

use Flarum\Foundation\ErrorHandling\HandledError;
use Flarum\Foundation\ErrorHandling\ViewFormatter;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CustomViewFormatter extends ViewFormatter
{
    public function format(HandledError $error, ServerRequestInterface $request): ResponseInterface
    {
        // Get the custom html for that error if it exists
        // This supports more codes than what is exposed in the extension settings
        $html = $this->settings->get('flagrow-html-errors.custom' . $error->getStatusCode() . 'ErrorHtml');

        if ($html) {
            return new HtmlResponse($html, $error->getStatusCode());
        }

        return parent::format($error, $request);
    }
}
