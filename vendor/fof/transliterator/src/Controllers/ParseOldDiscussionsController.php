<?php

/*
 * This file is part of fof/transliterator
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Transliterator\Controllers;

use Flarum\Discussion\Discussion;
use Flarum\User\AssertPermissionTrait;
use FoF\Transliterator\Transliterator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ParseOldDiscussionsController implements RequestHandlerInterface
{
    use AssertPermissionTrait;

    /**
     * Handle the request and return a response.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request)  : ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $counter = 0;

        $this->assertAdmin($actor);

        foreach (Discussion::cursor() as $discussion) {
            $slug = Transliterator::transliterate($discussion->title);

            if ($discussion->slug !== $slug) {
                $discussion->slug = $slug;
                $discussion->save();

                $counter++;
            }
        }

        return new JsonResponse([
            'success'   => true,
            'count'     => $counter,
        ]);
    }
}
