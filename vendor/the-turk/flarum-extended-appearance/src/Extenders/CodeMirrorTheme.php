<?php

namespace TheTurk\ExtendedAppearance\Extenders;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Frontend\Document;
use Flarum\Frontend\Frontend;
use Flarum\Http\UrlGenerator;
use Flarum\Extension\ExtensionManager;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Container\Container;

// shout out to my man Clark Winkelmann
// (flarum-ext-scratchpad) CodeMirrorTheme.php
// https://git.io/JfRIy
class CodeMirrorTheme implements ExtenderInterface
{
    /**
     * @param Container $container
     * @param Extension $extension
     */
    public function extend(Container $container, Extension $extension = null)
    {
        $container->resolving(
            'flarum.frontend.admin',
            function (Frontend $frontend, Container $container) {
                $urlGenerator = app(UrlGenerator::class);
                $extensions = app(ExtensionManager::class);
                $extensionFolder = '/the-turk-extended-appearance';
                $theme = $this->getTheme();

                // load pickr stylesheets
                $pickrStyles = $extensionFolder.'/pickr/monolith.min.css';
                $frontend->content(
                    function (Document $document) use ($urlGenerator, $pickrStyles) {
                        $document->css[] = $urlGenerator->to('forum')->path('assets/extensions' . $pickrStyles);
                    }
                );

                // load codemirror stylesheets
                if (!$extensions->isEnabled('clarkwinkelmann-scratchpad')) {
                    $frontend->content(
                        function (Document $document) use ($urlGenerator, $extensionFolder, $theme) {
                            $codeMirrorStyles = $extensionFolder . '/codemirror/codemirror.css';
                            $document->css[] = $urlGenerator->to('forum')->path('assets/extensions' . $codeMirrorStyles);

                            if ($theme !== 'default') {
                                $codeMirrorTheme = $extensionFolder . '/codemirror/' . $theme . '.css';
                                $document->css[] = $urlGenerator->to('forum')->path('assets/extensions' . $codeMirrorTheme);
                            }
                        }
                    );
                }
            }
        );

        $container['events']->listen(Serializing::class, [$this, 'attributes']);
    }

    /**
     * @param Serializing $event
     */
    public function attributes(Serializing $event)
    {
        if ($event->serializer instanceof ForumSerializer) {
            $event->attributes['appearanceCodeTheme'] = $this->getTheme();
        }
    }

    /**
     * Get the theme name
     * that'll be applied to CodeMirror
     */
    protected function getTheme()
    {
        $settings = app(SettingsRepositoryInterface::class);
        $extensions = app(ExtensionManager::class);

        if ($extensions->isEnabled('clarkwinkelmann-scratchpad')) {
            $theme = $settings->get('scratchpad.theme');
        } else {
            $theme = $settings->get('exap_theme_code_mirror_theme');
        }

        if (empty($theme) || $theme === 'auto') {
            if ($settings->get('theme_dark_mode') === '1') {
                $theme = 'darcula';
            } else {
                $theme = 'default';
            }
        }

        return $theme;
    }
}
