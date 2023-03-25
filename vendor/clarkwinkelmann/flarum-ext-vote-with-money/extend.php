<?php

namespace ClarkWinkelmann\VoteWithMoney;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use FoF\Polls\Api\Serializers\PollSerializer;
use FoF\Polls\Api\Serializers\PollVoteSerializer;
use FoF\Polls\Events\SavingPollAttributes;
use FoF\Polls\Poll;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attributes(ForumAttributes::class),

    (new Extend\ApiSerializer(PollSerializer::class))
        ->attributes(PollAttributes::class),
    (new Extend\ApiSerializer(PollVoteSerializer::class))
        ->attributes(VoteAttributes::class),

    (new Extend\ServiceProvider())
        ->register(Providers\PipeThroughPollVote::class),

    (new Extend\Policy())
        ->modelPolicy(Poll::class, Policies\PollPolicy::class),

    (new Extend\Event())
        ->listen(SavingPollAttributes::class, Listeners\SavePoll::class),
];
