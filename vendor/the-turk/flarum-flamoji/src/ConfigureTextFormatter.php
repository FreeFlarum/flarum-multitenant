<?php

namespace TheTurk\Flamoji;

use Flarum\Http\UrlGenerator;
use TheTurk\Flamoji\Models\Emoji;
use s9e\TextFormatter\Configurator;

class ConfigureTextFormatter
{
    /**
     * @param UrlGenerator $url
     */
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    /**
     * Configure s9e/TextFormatter
     *
     * @param Configurator $config
     */
    public function __invoke(Configurator $config)
    {
        $customEmojis = Emoji::all();

        foreach ($customEmojis as $emoji) {
            $path = $emoji->path;

            // check if the path starts with http:// or https://
            // We're using a similar thing on the urlChecker.js
            if (!preg_match('/http(s?)\:\/\//i', $path)) {
                $path = $this->url->to('forum')->base() . $path;
            }

            $config->Emoticons->add(
                $emoji->text_to_replace,
                '
                    <span class="flamoji">
                        <img src="' . $path . '" alt="' . $emoji->title . '" />
                    </span>
                '
            );
        }
    }
}
