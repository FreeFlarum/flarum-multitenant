<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Api\Controller;

use Askvortsov\FlarumWarnings\Api\Serializer\WarningSerializer;
use Askvortsov\FlarumWarnings\Model\Warning;
use Askvortsov\FlarumWarnings\Notification\WarningBlueprint;
use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Foundation\ValidationException;
use Flarum\Http\RequestUtil;
use Flarum\Locale\Translator;
use Flarum\Notification\NotificationSyncer;
use Flarum\Post\Post;
use Illuminate\Support\Carbon;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class CreateWarningController extends AbstractCreateController
{
    public $serializer = WarningSerializer::class;
    /**
     * @var NotificationSyncer
     */
    protected $notifications;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @param NotificationSyncer $notifications
     */
    public function __construct(NotificationSyncer $notifications, Translator $translator)
    {
        $this->notifications = $notifications;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertCan('user.manageWarnings');

        $requestData = $request->getParsedBody()['data']['attributes'];

        $publicComment = $requestData['public_comment'];

        if (trim($publicComment) === '') {
            throw new ValidationException(['message' => $this->translator->trans('askvortsov-moderator-warnings.forum.validation.public_comment_required')]);
        }

        $warning = new Warning();
        $warning->user_id = $requestData['userId'];
        $warning->public_comment = Warning::getFormatter()->parse($publicComment, new Post());
        $warning->private_comment = Warning::getFormatter()->parse($requestData['private_comment'], new Post());
        $warning->strikes = $requestData['strikes'];
        $warning->created_user_id = $actor->id;
        $warning->created_at = Carbon::now();

        if (array_key_exists('post', $requestData)) {
            $warning->post_id = $requestData['post']['data']['id'];
        }

        if (!$warning->strikes) {
            $warning->strikes = 0;
        }

        if ($warning->strikes < 0 || $warning->strikes > 5) {
            throw new ValidationException(['message' => $this->translator->trans('askvortsov-moderator-warnings.forum.validation.invalid_strike_count')]);
        }

        $warning->save();

        $this->notifications->sync(new WarningBlueprint($warning), [$warning->warnedUser]);

        return $warning;
    }
}
