<?php

namespace Kilowhat\Audit\Middlewares;

use Flarum\Http\RequestUtil;
use Kilowhat\Audit\AuditLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SetLoggerActor implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        AuditLogger::$ipAddress = $request->getAttribute('ipAddress');
        AuditLogger::$actor = RequestUtil::getActor($request);
        AuditLogger::$path = $request->getUri()->getPath();

        if ($request->getAttribute('session')) {
            AuditLogger::$client = 'session';
        } else if ($request->getAttribute('apiKey')) {
            AuditLogger::$client = 'api_key';
        } else {
            AuditLogger::$client = 'access_token';
        }

        return $handler->handle($request);
    }
}
