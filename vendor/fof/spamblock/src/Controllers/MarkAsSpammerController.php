<?php

/*
 * This file is part of fof/spamblock.
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoF\Spamblock\Controllers;

use Carbon\Carbon;
use Flarum\Discussion\Command\EditDiscussion;
use Flarum\Extension\ExtensionManager;
use Flarum\Flags\Command\DeleteFlags;
use Flarum\Post\Command\EditPost;
use Flarum\User\Command\EditUser;
use Flarum\User\User;
use FoF\Spamblock\Event\MarkedUserAsSpammer;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MarkAsSpammerController implements RequestHandlerInterface
{
    /**
     * @var Dispatcher
     */
    protected $bus;

    /**
     * @var EventsDispatcher
     */
    protected $events;

    /**
     * @var ExtensionManager
     */
    protected $extensions;

    /**
     * @param EventsDispatcher $events
     * @param Dispatcher       $bus
     * @param ExtensionManager $extensions
     */
    public function __construct(Dispatcher $bus, EventsDispatcher $events, ExtensionManager $extensions)
    {
        $this->bus = $bus;
        $this->events = $events;
        $this->extensions = $extensions;
    }

    /**
     * Handle the request and return a response.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');

        $userId = Arr::get($request->getQueryParams(), 'id');
        $user = User::findOrFail($userId);

        $actor->assertCan('spamblock', $user);

        $flarumSuspend = $this->extensions->isEnabled('flarum-suspend');
        $flarumFlags = $this->extensions->isEnabled('flarum-flags');

        if ($flarumSuspend && !isset($user->suspended_until)) {
            $this->bus->dispatch(
                new EditUser($user->id, $actor, [
                    'attributes' => ['suspendedUntil' => Carbon::now()->addYear(20)],
                ])
            );
        }

        $user->posts()->where('hidden_at', null)->chunk(50, function ($posts) use ($actor, $flarumFlags) {
            foreach ($posts as $post) {
                $this->bus->dispatch(
                    new EditPost($post->id, $actor, [
                        'attributes' => ['isHidden' => true],
                    ])
                );

                if ($flarumFlags) {
                    $this->bus->dispatch(
                        new DeleteFlags($post->id, $actor)
                    );
                }
            }
        });

        $user->discussions()->where('hidden_at', null)->chunk(50, function ($discussions) use ($actor) {
            foreach ($discussions as $discussion) {
                $this->bus->dispatch(
                    new EditDiscussion($discussion->id, $actor, [
                        'attributes' => ['isHidden' => true],
                    ])
                );
            }
        });

        $this->events->dispatch(
            new MarkedUserAsSpammer($user, $actor)
        );

        return (new Response())->withStatus(204);
    }
}
