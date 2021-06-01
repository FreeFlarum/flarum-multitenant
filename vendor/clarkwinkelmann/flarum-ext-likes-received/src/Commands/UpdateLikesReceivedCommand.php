<?php

namespace ClarkWinkelmann\LikesReceived\Commands;

use Flarum\User\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UpdateLikesReceivedCommand extends Command
{
    protected $signature = 'clarkwinkelmann:likes-received:refresh';
    protected $description = 'Re-computes the total number of likes received for each user';

    public function handle()
    {
        $progress = $this->output->createProgressBar(User::query()->count());

        User::query()->chunk(100, function (Collection $users) use ($progress) {
            $users->load(['posts' => function (HasMany $relationship) {
                $relationship->where('type', 'comment')
                    ->where('is_private', false);
            }]);

            foreach ($users as $user) {
                $user->posts->loadCount('likes');

                $user->clarkwinkelmann_likes_received_count = $user->posts->sum('likes_count');
                $user->save();

                $progress->advance();
            }
        });

        $this->line('Done.');
    }
}
