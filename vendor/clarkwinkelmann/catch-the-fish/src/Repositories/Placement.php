<?php

namespace ClarkWinkelmann\CatchTheFish\Repositories;

use Carbon\Carbon;
use ClarkWinkelmann\CatchTheFish\Fish;
use Flarum\Discussion\Discussion;
use Flarum\Extension\ExtensionManager;
use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use Flarum\Post\Post;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Placement
{
    public $discussionId;
    public $postId;
    public $userId;

    const TRANSLATION_PREFIX = 'clarkwinkelmann-catch-the-fish.api.';

    protected static function settingDiscussionAgeDays()
    {
        return resolve(SettingsRepositoryInterface::class)->get('catch-the-fish.discussionAgeDays', 14);
    }

    protected static function settingPostAgeDays()
    {
        return resolve(SettingsRepositoryInterface::class)->get('catch-the-fish.postAgeDays', 14);
    }

    protected static function settingPostProbability(): int
    {
        $probability = resolve(SettingsRepositoryInterface::class)->get('catch-the-fish.postProbability');

        if (!is_int($probability)) {
            return 50;
        }

        return $probability;
    }

    protected static function settingUserAgeDays()
    {
        return resolve(SettingsRepositoryInterface::class)->get('catch-the-fish.userAgeDays', 14);
    }

    protected static function settingUserProbability(): int
    {
        $probability = resolve(SettingsRepositoryInterface::class)->get('catch-the-fish.userProbability');

        if (!is_int($probability)) {
            return 33;
        }

        return $probability;
    }

    protected static function settingDiscussionTags()
    {
        return json_decode(resolve(SettingsRepositoryInterface::class)->get('catch-the-fish.discussionTags') ?: '[]', true);
    }

    /**
     * @throws ValidationException
     */
    public function assertValid(): void
    {
        /**
         * @var $translator Translator
         */
        $translator = resolve(Translator::class);

        // One and only one anchor resource must be chosen
        if (!is_null($this->discussionId) + !is_null($this->postId) + !is_null($this->userId) !== 1) {
            throw new ValidationException([
                'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'too-many-placement-models'),
            ]);
        }

        $model = null;

        switch (false) {
            case is_null($this->discussionId):
                if (!($model = Discussion::query()->where('id', $this->discussionId)->first())) {
                    throw new ValidationException([
                        'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'invalid-discussion-id'),
                    ]);
                }
                break;
            case is_null($this->postId):
                if (!($model = Post::query()->where('id', $this->postId)->first())) {
                    throw new ValidationException([
                        'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'invalid-post-id'),
                    ]);
                }
                break;
            case is_null($this->userId):
                if (!($model = User::query()->where('id', $this->userId)->first())) {
                    throw new ValidationException([
                        'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'invalid-user-id'),
                    ]);
                }
                break;
        }

        if ($model instanceof Discussion || $model instanceof Post) {
            if (!is_null($model->hidden_at)) {
                throw new ValidationException([
                    'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'model-deleted'),
                ]);
            }

            if ($model->is_private) {
                throw new ValidationException([
                    'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'model-private'),
                ]);
            }

            /**
             * @var $extensions ExtensionManager
             */
            $extensions = resolve(ExtensionManager::class);

            $tagSettings = self::settingDiscussionTags();

            if ($extensions->isEnabled('flarum-tags') && is_array($tagSettings) && count($tagSettings)) {
                if ($model instanceof Post) {
                    $discussion = $model->discussion;
                } else {
                    $discussion = $model;
                }

                if (!$discussion->tags()->whereIn('id', Arr::pluck($tagSettings, 'tagId'))->exists()) {
                    throw new ValidationException([
                        'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'tag-not-allowed'),
                    ]);
                }
            }
        }

        if ($model instanceof Discussion) {
            if (is_null($model->last_posted_at) || $model->last_posted_at->lt(Carbon::now()->subDays(self::settingDiscussionAgeDays()))) {
                throw new ValidationException([
                    'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'inactive-discussion', [
                        '{days}' => self::settingDiscussionAgeDays(),
                    ]),
                ]);
            }
        } else if ($model instanceof Post) {
            if ($model->created_at->lt(Carbon::now()->subDays(self::settingPostAgeDays()))) {
                throw new ValidationException([
                    'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'inactive-post', [
                        '{days}' => self::settingDiscussionAgeDays(),
                    ]),
                ]);
            }

            if ($model->type !== 'comment') {
                throw new ValidationException([
                    'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'non-comment-post'),
                ]);
            }
        } else if ($model instanceof User) {
            if (is_null($model->last_seen_at) || $model->last_seen_at->lt(Carbon::now()->subDays(self::settingUserAgeDays()))) {
                throw new ValidationException([
                    'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'inactive-user', [
                        '{days}' => self::settingUserAgeDays(),
                    ]),
                ]);
            }

            /**
             * @var $extensions ExtensionManager
             */
            $extensions = resolve(ExtensionManager::class);

            if ($extensions->isEnabled('flarum-suspend') && !is_null($model->suspended_until) && $model->suspended_until->gt(Carbon::now())) {
                throw new ValidationException([
                    'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'user-suspended'),
                ]);
            }
        }
    }

    /**
     * @return Model|User|null
     */
    protected static function randomUser(): ?User
    {
        $query = User::query()
            ->where('last_seen_at', '>', Carbon::now()->subDays(self::settingUserAgeDays()))
            ->whereHas('posts');

        /**
         * @var $extensions ExtensionManager
         */
        $extensions = resolve(ExtensionManager::class);

        if ($extensions->isEnabled('flarum-suspend')) {
            $query->whereNull('suspended_until');
        }

        return $query->inRandomOrder()->first();
    }

    /**
     * @return Model|Discussion
     */
    protected static function randomDiscussion($tagId = null): Discussion
    {
        $query = Discussion::query()
            ->where('is_private', false)
            ->whereNull('hidden_at')
            ->where('last_posted_at', '>', Carbon::now()->subDays(self::settingDiscussionAgeDays()));

        if ($tagId) {
            $query->whereHas('tags', function (Builder $query) use ($tagId) {
                $query->where('id', $tagId);
            });
        }

        return $query->inRandomOrder()->first();
    }

    /**
     * @return Model|Post|null
     */
    protected static function randomPost(Discussion $discussion): ?Post
    {
        return $discussion
            ->comments()
            ->where('created_at', '>', Carbon::now()->subDays(self::settingPostAgeDays()))
            ->inRandomOrder()
            ->first();
    }

    public static function random(): self
    {
        $rand = random_int(1, 100);

        $placement = new self();

        if (random_int(0, 99) < self::settingUserProbability()) {
            $user = self::randomUser();

            if ($user) {
                $placement->userId = $user->id;

                return $placement;
            }
        }

        /**
         * @var $extensions ExtensionManager
         */
        $extensions = resolve(ExtensionManager::class);

        $tagSettings = self::settingDiscussionTags();

        $discussion = null;

        if ($extensions->isEnabled('flarum-tags') && is_array($tagSettings) && count($tagSettings)) {
            foreach ($tagSettings as $index => $tagSetting) {

                if ($index !== count($tagSettings) - 1 && random_int(0, 99) >= Arr::get($tagSetting, 'probability')) {
                    continue;
                }

                $discussion = self::randomDiscussion(Arr::get($tagSetting, 'tagId'));

                if ($discussion) {
                    break;
                }
            }
        } else {
            $discussion = self::randomDiscussion();
        }

        if (!$discussion) {
            /**
             * @var $translator Translator
             */
            $translator = resolve(Translator::class);

            throw new ValidationException([
                'placement' => $translator->trans(self::TRANSLATION_PREFIX . 'random-error'),
            ]);
        }

        if (random_int(0, 99) < self::settingPostProbability()) {
            $post = self::randomPost($discussion);

            if ($post) {
                $placement->postId = $post->id;

                return $placement;
            }
        }

        $placement->discussionId = $discussion->id;

        return $placement;
    }

    public function assign(Fish $fish)
    {
        $fish->discussion_id_placement = $this->discussionId;
        $fish->post_id_placement = $this->postId;
        $fish->user_id_placement = $this->userId;
    }
}
