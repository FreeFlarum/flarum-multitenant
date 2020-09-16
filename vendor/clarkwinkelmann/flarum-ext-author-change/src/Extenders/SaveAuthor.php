<?php

namespace ClarkWinkelmann\AuthorChange\Extenders;

use Carbon\Carbon;
use ClarkWinkelmann\AuthorChange\Event;
use ClarkWinkelmann\AuthorChange\Validators\TimeValidator;
use Flarum\Database\AbstractModel;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving as DiscussionSaving;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Post\Event\Saving as PostSaving;
use Flarum\Post\Post;
use Flarum\User\AssertPermissionTrait;
use Flarum\User\User;
use Illuminate\Contracts\Container\Container;

class SaveAuthor implements ExtenderInterface
{
    use AssertPermissionTrait;

    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(DiscussionSaving::class, [$this, 'saveDiscussion']);
        $container['events']->listen(PostSaving::class, [$this, 'savePost']);
    }

    public function saveDiscussion(DiscussionSaving $event)
    {
        $this->saveAuthor($event->discussion, $event->actor, $event->data);
    }

    public function savePost(PostSaving $event)
    {
        $this->saveAuthor($event->post, $event->actor, $event->data);
    }

    /**
     * @param AbstractModel|Discussion|Post $model
     * @param User $actor
     * @param array $data
     * @throws \Flarum\User\Exception\PermissionDeniedException
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function saveAuthor(AbstractModel $model, User $actor, array $data)
    {
        if (isset($data['relationships']['user']['data'])) {
            $this->assertCan($actor, 'clarkwinkelmann-author-change.edit-user');

            if ($model instanceof Post) {
                $model->raise(new Event\PostUserChanged($model, $model->user));
            } else {
                $model->raise(new Event\DiscussionUserChanged($model, $model->user));
            }

            if (isset($data['relationships']['user']['data']['id'])) {
                $userId = $data['relationships']['user']['data']['id'];
                $user = User::query()->findOrFail($userId);

                $model->user()->associate($user);

                // Update discussion meta when editing a post
                if ($model instanceof Post) {
                    $model->afterSave(function () use ($model) {
                        $model->discussion->refreshParticipantCount();

                        if ($model->id === $model->discussion->last_post_id) {
                            $model->discussion->setLastPost($model);
                        }

                        $model->discussion->save();
                    });
                }
            } else if (empty($data['relationships']['user']['data'])) {
                $model->user()->dissociate();
            }
        }

        if (isset($data['attributes']['createdAt'])) {
            $this->assertCan($actor, 'clarkwinkelmann-author-change.edit-date');

            /**
             * @var $validator TimeValidator
             */
            $validator = app(TimeValidator::class);
            $validator->assertValid([
                'time' => $data['attributes']['createdAt'],
            ]);

            if ($model instanceof Post) {
                $model->raise(new Event\PostCreateDateChanged($model, $model->created_at));
            } else {
                $model->raise(new Event\DiscussionCreateDateChanged($model, $model->created_at));
            }

            $model->created_at = Carbon::parse($data['attributes']['createdAt']);
        }

        if (isset($data['attributes']['editedAt']) && $model instanceof Post) {
            $this->assertCan($actor, 'clarkwinkelmann-author-change.edit-date');

            $model->raise(new Event\PostEditDateChanged($model, $model->edited_at));

            if (empty($data['attributes']['editedAt'])) {
                $model->edited_at = null;
            } else {
                /**
                 * @var $validator TimeValidator
                 */
                $validator = app(TimeValidator::class);
                $validator->assertValid([
                    'time' => $data['attributes']['editedAt'],
                ]);

                $model->edited_at = Carbon::parse($data['attributes']['editedAt']);
            }
        }
    }
}
