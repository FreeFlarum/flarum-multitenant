<?php

namespace Nearata\MinecraftAvatars;

use Flarum\Console\AbstractCommand;
use Flarum\User\User;

use Illuminate\Database\Eloquent\Collection;

use Nearata\MinecraftAvatars\Helpers;

class MigrateCommand extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('mcmigrate');
    }

    protected function fire()
    {
        $this->info('Starting migration...');

        User::query()->chunk(100, function (Collection $users) {
            $users->each(function (User $user) {
                $minotar = $user->minotar;

                if (!is_null($minotar) && Helpers::isUsername($minotar)) {
                    $uuid = Helpers::getUUID($minotar);

                    if (empty($uuid)) {
                        return $this->error("Username $minotar cannot be migrated. Not found.");
                    }

                    $user->minotar = $uuid;
                    $user->save();
                }
            });
        });

        $this->info('Migration Complete.');
    }
}
