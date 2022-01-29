<?php

namespace Webbinaro\GpxPreview\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use FoF\Upload\Helpers\Util;
use Webbinaro\GpxPreview\Templates\GpxTemplate;
use Flarum\Settings\SettingsRepositoryInterface;

class GpxPreviewProvider extends AbstractServiceProvider
{    
	

    public function register()
    {
        /** @var Util $util */
        $util = $this->container->make(Util::class);

        $util->addRenderTemplate($this->container->make(GpxTemplate::class));
    }
}
