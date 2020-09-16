<?php
/**
 * (c) 2019  Matthew Kilgore <matthew@kilgore.dev>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 */

namespace Tank\Perspective\Listener;


use Flarum\Flags\Flag;
use Flarum\Post\Event\Saving;
use Flarum\Settings\SettingsRepositoryInterface;
use PerspectiveApi\CommentsClient;

class ValidatePost
{
    protected $perspective;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function handle(Saving $event)
    {
        $post = $event->post;

        $doNotStore = $this->settings->get('perspective.donotstore');
        if ($doNotStore == null) {
            $doNotStore = false;
        }
        $requestAttributes = array();
        if ($this->settings->get('perspective.models.toxicity') && !$this->settings->get('perspective.useexperimental')) {
            $requestAttributes['TOXICITY'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        if ($this->settings->get('perspective.models.toxicity') && $this->settings->get('perspective.useexperimental')) {
            $requestAttributes['TOXICITY_EXPERIMENTAL'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        if ($this->settings->get('perspective.models.threat') && !$this->settings->get('perspective.useexperimental')) {
            $requestAttributes['THREAT'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        if ($this->settings->get('perspective.models.threat') && $this->settings->get('perspective.useexperimental')) {
            $requestAttributes['THREAT_EXPERIMENTAL'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        if ($this->settings->get('perspective.models.profanity') && !$this->settings->get('perspective.useexperimental')) {
            $requestAttributes['PROFANITY'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        if ($this->settings->get('perspective.models.profanity') && $this->settings->get('perspective.useexperimental')) {
            $requestAttributes['PROFANITY_EXPERIMENTAL'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        if ($this->settings->get('perspective.models.sexually_explicit')) {
            $requestAttributes['SEXUALLY_EXPLICIT'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        if ($this->settings->get('perspective.models.flirtation')) {
            $requestAttributes['FLIRTATION'] = ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0];
        }
        try {
            $perspectiveClient = new CommentsClient($this->settings->get('perspective.api_key'));
            $perspectiveClient->comment(['text' => $post->content]);
            $perspectiveClient->doNotStore($doNotStore);
            $perspectiveClient->requestedAttributes($requestAttributes);
            $response = $perspectiveClient->analyze();
            $scores = array();
            foreach ($response->attributeScores() as $score) {
                $scores[] = $score['summaryScore']['value'];
            }
            $scores = array_filter($scores);
            if ($this->settings->get('perspective.usemax')) {
                $score = max($scores);
            } else {
                $score = array_sum($scores) / count($scores);
            }
            $isToxic = $score * 100 >= $this->settings->get('perspective.threshold') ? true : false;
            if ($isToxic) {
                //$post->is_approved = false;
                $post->afterSave(function ($post) {
                    // Do not approve the discussion if only one post
                    //if ($post->number == 1) {
                    //    $post->discussion->is_approved = false;
                    //    $post->discussion->save();
                    //}
                    // Flag the post/discussion
                    $flag = new Flag();
                    $flag->post_id = $post->id;
                    $flag->type = 'perspective';
                    $flag->created_at = time();
                    $flag->save();
                });
            }
        } catch (\Exception $exception) {
            app('log')->error($exception);
        }
    }
}
