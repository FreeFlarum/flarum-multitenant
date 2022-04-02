<?php

namespace Justoverclock\Feedback\Api\Controller;

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Http\RequestUtil;
use Flarum\Locale\Translator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Arr;
use Justoverclock\Feedback\Api\Serializer\SubmitFeedbackSerializer;
use Justoverclock\Feedback\Validator\FeedbackValidator;
use Psr\Http\Message\ServerRequestInterface;
use stdClass;
use Tobscure\JsonApi\Document;

class SubmitFeedbackController extends AbstractCreateController
{
    public $serializer = SubmitFeedbackSerializer::class;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * @var FeedbackValidator
     */
    protected $validator;
    
    public function __construct(SettingsRepositoryInterface $settings, Translator $translator, Mailer $mailer, FeedbackValidator $validator)
    {
        $this->settings = $settings;
        $this->translator = $translator;
        $this->mailer = $mailer;
        $this->validator = $validator;
    }
    
    public function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $data = $request->getParsedBody();
        
        $feedback = new stdClass();
        $feedback->id = 'feedback';
        $feedback->feedbackType = Arr::get($data, 'feedbackType');
        $feedback->email = Arr::get($data, 'email');
        $feedback->message = Arr::get($data, 'message');
        $feedback->url = Arr::get($data, 'url');

        $this->validator->assertValid(['message' => $feedback->message]);

        $this->sendEmail($feedback, $actor);

        return $feedback;
    }

    private function sendEmail(stdClass $feedback, User $actor): void
    {
        $subject = $this->translator->trans('justoverclock-feedback.forum.email.subject');
        $body = $this->translator->trans('justoverclock-feedback.forum.email.body', [
            'type'    => $feedback->feedbackType,
            'message' => $feedback->message,
            'email'   => $feedback->email,
            'url'     => $feedback->url,
            'user'    => $actor->isGuest() ? $this->translator->trans('justoverclock-feedback.forum.email.guest') : $actor->display_name
        ]);

        $recipient = $this->settings->get('justoverclock-feedback.ContactMail');

        if (!empty($recipient)) {
            $this->mailer->raw($body, function (Message $message) use ($subject, $recipient) {
                $message->to($recipient)->subject($subject);
            });
        }
    }
}
