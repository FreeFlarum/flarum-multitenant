<?php

namespace Blomstra\Spam\Filters;

use Blomstra\Spam\Concerns;
use FoF\UserBio\Event\BioChanged;
use Illuminate\Contracts\Events\Dispatcher;

class UserBio
{
    use Concerns\Users,
        Concerns\Content;

    public function subscribe(Dispatcher $events)
    {
        $events->listen(BioChanged::class, [$this, 'filter']);
    }

    public function filter(BioChanged $event)
    {
        if(
            // Allow modifications by elevated users.
            $event->actor->is($event->user)
            // Ignore any elevated user.
            && ! $this->isElevatedUser($event->actor)
            // Confirm this user is new.
            && $this->isFreshUser($event->user)
            // Bio content contains problematic content/spam.
            && $this->containsProblematicContent($event->user->bio)
        ) {
            $user = $event->user;

            // Retrieve original bio - if exists - to restore to.
            $originalBio = $user->getOriginal('bio');

            if (! $this->containsProblematicContent($originalBio)) {
                // If original content isn't problematic, reset to that
                $user->bio = $originalBio;
            } else {
                // Otherwise use a generic message.
                $user->bio = '[Bio has been auto moderated]';
            }

            // Only run the update in case modifications are made.
            $user->isDirty('bio') && $user->save();
        }
    }
}
