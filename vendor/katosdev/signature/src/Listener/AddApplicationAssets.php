<?php
namespace katosdev\Signature\Listener;

use Flarum\Extend\Frontend;
use Flarum\Extend\Routes;
use Flarum\Extend\Locales;
use DirectoryIterator;
use Illuminate\Contracts\Events\Dispatcher;
use katosdev\Signature\Validation\ValidateSignature;

class AddApplicationAssets
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureWebApp::class, [$this, 'addAssets']);
        $events->listen(ConfigureForumRoutes::class, [$this, 'addRoutes']);
        $events->listen(ConfigureApiRoutes::class, [$this, 'addApiRoutes']);
        $events->listen(ConfigureLocales::class, [$this, 'addLocales']);

    }

    public function addAssets(ConfigureWebApp $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__ . '/../../js/forum/dist/extension.js',
                __DIR__ . '/../../less/signature.less',
                __DIR__ . '/../../less/trumbowyg.less',
            ]);
            $event->addBootstrapper('katosdev/signature/main');
        }
        if ($event->isAdmin()) {
            $event->addAssets([
                __DIR__.'/../../js/admin/dist/extension.js'
            ]);
            $event->addBootstrapper('katosdev/signature/main');
        }
    }

    /**
     * Provides i18n files.
     *
     * @param ConfigureLocales $event
     */
    public function addLocales(ConfigureLocales $event)
    {
        foreach (new DirectoryIterator(__DIR__ . '/../../locale') as $file) {
            if ($file->isFile() && in_array($file->getExtension(), ['yml', 'yaml'])) {
                $event->locales->addTranslations($file->getBasename('.' . $file->getExtension()), $file->getPathname());
            }
        }
    }

    public function addRoutes(ConfigureForumRoutes $event)
    {
        $event->get('/settings/signature', 'settings.signature');
    }

    public function addApiRoutes(ConfigureApiRoutes $event)
    {
        $event->post('/settings/signature/validate', 'settings.signature', ValidateSignature::class);
    }
}
