<?php

namespace ClarkWinkelmann\MoneyToAll\Controllers;

use AntoineFr\Money\Event\MoneyUpdated;
use Carbon\Carbon;
use ClarkWinkelmann\MoneyToAll\Notifications\MoneyReceivedBlueprint;
use ClarkWinkelmann\MoneyToAll\Record;
use Flarum\Extension\ExtensionManager;
use Flarum\Http\RequestUtil;
use Flarum\Notification\NotificationSyncer;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SendMoney implements RequestHandlerInterface
{
    protected $dispatcher;
    protected $notifications;
    protected $validation;
    protected $extensions;

    public function __construct(Dispatcher $dispatcher, NotificationSyncer $notifications, Factory $validation, ExtensionManager $extensions)
    {
        $this->dispatcher = $dispatcher;
        $this->notifications = $notifications;
        $this->validation = $validation;
        $this->extensions = $extensions;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertAdmin();

        $query = User::query();

        if (!Arr::get($request->getParsedBody(), 'suspended') && $this->extensions->isEnabled('flarum-suspend')) {
            $query->where(function (Builder $builder) {
                $builder->whereNull('suspended_until')
                    ->orWhere('suspended_until', '<', Carbon::now());
            });
        }

        $lastActivity = (string)Arr::get($request->getParsedBody(), 'lastActivity');

        if ($lastActivity) {
            $lastActivityDate = Carbon::parse($lastActivity);

            $query->where('last_seen_at', '>=', $lastActivityDate);
        }

        $count = $query->count();

        $amount = (float)Arr::get($request->getParsedBody(), 'amount');
        $notify = (bool)Arr::get($request->getParsedBody(), 'notify');
        $message = (string)Arr::get($request->getParsedBody(), 'message') ?: null;

        $this->validation->make(compact('amount', 'message'), [
            'amount' => 'required|numeric|min:0',
            'message' => 'nullable|string|max:20000',
        ])->validate();

        if (!Arr::get($request->getParsedBody(), 'dryRun')) {
            $record = new Record();
            $record->amount = $amount;
            $record->user()->associate($actor);
            $record->save();

            $recipients = [];

            $query->each(function (User $user) use ($amount, $notify, $message, &$recipients) {
                $user->money += $amount;
                $user->save();

                $this->dispatcher->dispatch(new MoneyUpdated($user));

                if ($notify) {
                    $recipients[] = $user;
                }
            });

            if ($notify) {
                $this->notifications->sync(new MoneyReceivedBlueprint($record, $amount, $message), $recipients);
            }
        }

        return new JsonResponse([
            'userMatchCount' => $count,
        ]);
    }
}
