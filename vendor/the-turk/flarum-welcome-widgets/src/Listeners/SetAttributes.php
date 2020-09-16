<?php
namespace TheTurk\WelcomeWidgets\Listeners;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Post\Post;
use Flarum\User\User;
use Flarum\User\Event\LoggedIn;
use Illuminate\Contracts\Events\Dispatcher;
use TheTurk\WelcomeWidgets\Api\Serializers\WelcomeWidgetsSerializer;
use TheTurk\WelcomeWidgets\Models\WelcomeWidgets;

class SetAttributes
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(LoggedIn::class, [$this, 'whenLoggedIn']);
        $events->listen(Serializing::class, [$this, 'prepareApiAttributes']);
    }

    /**
     * @param LoggedIn $event
     */
    public function whenLoggedIn(LoggedIn $event)
    {
        $lastStats = [
          'discussions' => $this->getDiscussionsCount(),
          'posts'       => $this->getPostsCount(),
          'users'       => $this->getUsersCount()
        ];

        $stats = WelcomeWidgets::where('user_id', $event->user->id)->first();

        if ($stats) {
          $stats->previous_login_at = $stats->last_login_at;
          $stats->previous_stats = $stats->last_stats;
        } else {
          $stats = new WelcomeWidgets;
          $stats->user_id = $event->user->id;
          $stats->previous_stats = json_encode($lastStats);
          $stats->previous_login_at = $event->user->last_seen_at;
        }

        $stats->last_stats = json_encode($lastStats);
        $stats->last_login_at = $event->user->last_seen_at;
        $stats->save();
    }

    /**
     * @param Serializing $event
     */
    public function prepareApiAttributes(Serializing $event)
    {
        if ($event->isSerializer(ForumSerializer::class)) {
            $event->attributes['ww_discussionsCount'] = $this->getDiscussionsCount();
            $event->attributes['ww_postsCount'] = $this->getPostsCount();
            $event->attributes['ww_usersCount'] = $this->getUsersCount();
        }

        if ($event->isSerializer(UserSerializer::class)) {
            $stats = WelcomeWidgets::where('user_id', $event->model->id)->first();

            if ($stats) {
              $previousStats = json_decode($stats->previous_stats, true);

              $event->attributes['ww_previousLoginAt'] = $event->formatDate($stats->previous_login_at);
              $event->attributes['ww_lastLoginDiscussionsCount'] = $previousStats['discussions'];
              $event->attributes['ww_lastLoginPostsCount'] = $previousStats['posts'];
              $event->attributes['ww_lastLoginUsersCount'] = $previousStats['users'];
            }
        }
    }

    /*
     * Get the total number of discussions.
     *
     * @return int
     */
    private function getDiscussionsCount()
    {
      return Discussion::count();
    }

    /*
     * Get the total number of users.
     *
     * @return int
     */
    private function getUsersCount()
    {
      return User::count();
    }

    /*
     * Get the total number of posts.
     * Moderator related actions will be excluded.
     *
     * @return int
     */
    private function getPostsCount()
    {
      return Post::where('type', 'comment')->count();
    }
}
