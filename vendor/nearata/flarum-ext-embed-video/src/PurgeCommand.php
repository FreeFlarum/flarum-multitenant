<?php

namespace Nearata\EmbedVideo;

use Flarum\Console\AbstractCommand;
use Flarum\Post\Post;
use Illuminate\Support\Str;

class PurgeCommand extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('nearataEmbedVideo:purge');
    }

    protected function fire()
    {
        Post::all()->each(function (Post $item) {
            if ($item->type != 'comment') {
                return true;
            }

            if (is_null($item->content)) {
                return true;
            }

            if (!Str::contains($item->content, '[embed-video')) {
                return true;
            }

            $item->content = preg_replace('/\[embed-video\s.*?\]/i', '', $item->content);
            $item->save();
        });
    }
}
