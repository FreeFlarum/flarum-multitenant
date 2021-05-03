<?php

namespace ClarkWinkelmann\AuthorChange\Listeners;

use Carbon\Carbon;
use ClarkWinkelmann\AuthorChange\Event;
use ClarkWinkelmann\AuthorChange\Validators\TimeValidator;
use Flarum\Database\AbstractModel;
use Flarum\Discussion\Discussion;
use Flarum\Post\Post;
use Flarum\User\User;

abstract class AbstractSaveAuthor
{
    protected $timeValidator;

    public function __construct(TimeValidator $timeValidator)
    {
        $this->timeValidator = $timeValidator;
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
            $actor->assertCan('clarkwinkelmann-author-change.edit-user');

            if ($model instanceof Post) {
                $model->raise(new Event\PostUserChanged($model, $model->user));
            } else {
                $model->raise(new Event\DiscussionUserChanged($model, $model->user));
            }

            $oldUser = $model->user;
            $newUser = null;

            if (isset($data['relationships']['user']['data']['id'])) {
                $userId = $data['relationships']['user']['data']['id'];
                $newUser = User::query()->findOrFail($userId);

                $model->user()->associate($newUser);

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

            // Update user metadata
            $model->afterSave(function () use ($model, $oldUser, $newUser) {
                if ($oldUser) {
                    if ($model instanceof Post) {
                        $oldUser->refreshCommentCount();
                    } else {
                        $oldUser->refreshDiscussionCount();
                    }

                    $oldUser->save();
                }

                if ($newUser) {
                    if ($model instanceof Post) {
                        $newUser->refreshCommentCount();
                    } else {
                        $newUser->refreshDiscussionCount();
                    }

                    $newUser->save();
                }
            });
        }

        if (isset($data['attributes']['createdAt'])) {
            $actor->assertCan('clarkwinkelmann-author-change.edit-date');

            $this->timeValidator->assertValid([
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
            $actor->assertCan('clarkwinkelmann-author-change.edit-date');

            $model->raise(new Event\PostEditDateChanged($model, $model->edited_at));

            if (empty($data['attributes']['editedAt'])) {
                $model->edited_at = null;
            } else {
                $this->timeValidator->assertValid([
                    'time' => $data['attributes']['editedAt'],
                ]);

                $model->edited_at = Carbon::parse($data['attributes']['editedAt']);
            }
        }
    }
}
