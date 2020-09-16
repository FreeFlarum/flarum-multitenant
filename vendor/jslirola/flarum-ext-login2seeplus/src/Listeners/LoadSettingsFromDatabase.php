<?php

namespace JSLirola\Login2SeePlus\Listeners;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Api\Event\Serializing;
use Flarum\Settings\SettingsRepositoryInterface;
use Symfony\Component\Translation\TranslatorInterface;

class LoadSettingsFromDatabase
{
    protected $settings;
    protected $translator;
    protected $fields = [
        'post',
        'link',
        'image',
        'php',
        'code'
    ];

    public function __construct(SettingsRepositoryInterface $settings, TranslatorInterface $translator)
    {
        $this->settings = $settings;
        $this->translator = $translator;
    }

    private function truncate_html($string, $length)
    {
        $string = trim($string);
        $i = 0;
        $tags = array();

        preg_match_all('/<[^>]+>([^<]*)/', $string, $tagMatches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
        foreach($tagMatches as $tagMatch)
        {
            if ($tagMatch[0][1] - $i >= $length)
                break;
            $tag = mb_substr(strtok($tagMatch[0][0], " \t\n\r\0\x0B>"), 1);
            if ($tag[0] != '/')
                $tags[] = $tag;
            elseif (end($tags) == mb_substr($tag, 1))
                array_pop($tags);
            $i += $tagMatch[1][1] - $tagMatch[0][1];
        }

        return mb_substr($string, 0, $length = min(mb_strlen($string), $length + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
    }

    private function get_link($trans)
    {
        return '<a class="l2sp">' . $this->translator->trans($trans) . '</a>';
    }

    public function handle(Serializing $event)
    {
        if ($event->isSerializer(ForumSerializer::class))
        {
            foreach ($this->fields as $field)
            {
                $k = 'jslirola.login2seeplus.' . $field;
                $event->attributes[$k] = $this->settings->get($k);
            }
        }
        else if ($event->isSerializer(PostSerializer::class))
        {
            if (!$event->actor->isGuest())
                return;

            $s_php = $this->settings->get('jslirola.login2seeplus.php', false);
            if (!$s_php)
                return;

            $s_post = (int)$this->settings->get('jslirola.login2seeplus.post', 100);
            $s_link = $this->settings->get('jslirola.login2seeplus.link', false);
            $s_image = $this->settings->get('jslirola.login2seeplus.image', false);
            $s_code = $this->settings->get('jslirola.login2seeplus.code', false);

            $newHTML = $event->attributes['contentHtml'];

            // truncate
            if ($s_post != -1 && function_exists('mb_substr') && function_exists('mb_strlen')) {
                $newHTML =  $this->truncate_html($newHTML, $s_post);
                $newHTML = preg_replace('/(<p>)([^<]*)<\/p>$/is', '$1$2...$3', $newHTML);
            }

            // links
            if ($s_link == 1) {
                $newHTML = preg_replace('/(<a((?!PostMention).)*?>)[^<]*<\/a>/is', $this->get_link('jslirola-login2seeplus.forum.link'), $newHTML);
//                $newHTML = preg_replace('/<GOOGLEDRIVE(.*?)>[^>]*<\/GOOGLEDRIVE>/is', $this->get_link('jslirola-login2seeplus.forum.link'), $newHTML);
//                $newHTML = preg_replace('/<GOOGLESHEETS(.*?)>[^>]*<\/GOOGLESHEETS>/is', $this->get_link('jslirola-login2seeplus.forum.link'), $newHTML);
                $newHTML = preg_replace('/<span data-s9e-mediaembed=(.*?)><span (.*?)><iframe(.*?)><\/iframe><\/span><\/span>/is', $this->get_link('jslirola-login2seeplus.forum.link'), $newHTML);
                $newHTML = preg_replace('/<iframe data-s9e-mediaembed=(.*?)><\/iframe>/is', $this->get_link('jslirola-login2seeplus.forum.link'), $newHTML);
            } elseif ($s_link == 2) // hide address
                $newHTML = preg_replace('/<a href=".*?"/is', '<a class="l2sp"', $newHTML);

            // images
            if ($s_image)
                $newHTML = preg_replace('/<img((.(?!class=))*)\/?>/is', '<div class="jslirolaLogin2seeplusImgPlaceholder">' . $this->get_link('jslirola-login2seeplus.forum.image') . '</div>', $newHTML);

            // code
            if ($s_code) {
                $newHTML = preg_replace('/<pre><code(.*?)>[^>]*<\/pre>/is', $this->get_link('jslirola-login2seeplus.forum.code'), $newHTML);
                $newHTML = preg_replace('/<code(.*?)>[^>]*<\/code>/is', $this->get_link('jslirola-login2seeplus.forum.code'), $newHTML);
            }

            // show alert
            if ($s_post != -1)
                $newHTML .= '<div class="jslirolaLogin2seeplusAlert">' . $this->translator->trans('jslirola-login2seeplus.forum.post', array(
                    '{login}' => '<a class="jslirolaLogin2seeplusLogin">' . $this->translator->trans('core.forum.header.log_in_link') . '</a>',
                    '{register}' => '<a class="jslirolaLogin2seeplusRegister">' . $this->translator->trans('core.forum.header.sign_up_link') . '</a>'
                )) . '</div>';

            $event->attributes['contentHtml'] = $newHTML;

        }
        else if ($event->isSerializer(BasicPostSerializer::class) && !is_null($event->attributes["contentHtml"]))
        {
            if (!$event->actor->isGuest())
                return;

            $s_summary_links = $this->settings->get('jslirola.login2seeplus.link', false);

            if ($s_summary_links == 1)
                $event->attributes['contentHtml'] = preg_replace('/(<a((?!PostMention).)*?>)[^<]*<\/a>/is',
                    '[' . $this->get_link('jslirola-login2seeplus.forum.link') . ']', $event->attributes['contentHtml']);

        }
    }
}
