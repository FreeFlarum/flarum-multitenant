<?php

namespace Afrux\ThemeBase\Extend;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Extend;
use Flarum\Extension\Extension;
use Flarum\Frontend\Document;
use Illuminate\Contracts\Container\Container;

class DashboardLayout implements Extend\ExtenderInterface
{
    private $actions = [];

    public function splitToNavAndContent()
    {
        $this->actions[] = 'splitToNavAndContent';

        return $this;
    }

    public function normalizeStatusWidgetStructure()
    {
        $this->actions[] = 'normalizeStatusWidgetStructure';

        return $this;
    }

    public function normalizeAdminHeaderStructure()
    {
        $this->actions[] = 'normalizeAdminHeaderStructure';

        return $this;
    }

    public function normalizeExtensionPageStructure()
    {
        $this->actions[] = 'normalizeExtensionPageStructure';

        return $this;
    }

    public function normalizeUserTable()
    {
        $this->actions[] = 'normalizeUserTable';

        return $this;
    }

    public function addExtensionsPage()
    {
        $this->actions[] = 'addExtensionsPage';

        return $this;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        if (in_array('splitToNavAndContent', $this->actions, true)) {
            (new Extend\Frontend('admin'))
                ->css(__DIR__.'/../../less/admin/extenders/SplitLayout.less')
                ->content(function (Document $document) {
                    $document->layoutView = "afrux-theme-base::frontend.admin";
                })
                ->extend($container, $extension);
        }

        $serializer = new Extend\ApiSerializer(ForumSerializer::class);
        $exposableActions = [
            'normalizeStatusWidgetStructure',
            'normalizeAdminHeaderStructure',
            'normalizeExtensionPageStructure',
            'normalizeUserTable',
            'addExtensionsPage',
        ];

        foreach ($exposableActions as $action) {
            $serializer = $serializer->attribute("afrux-theme-base.$action", function () use ($action) {
                return in_array($action, $this->actions, true);
            });
        }

        $serializer->extend($container, $extension);
    }
}
