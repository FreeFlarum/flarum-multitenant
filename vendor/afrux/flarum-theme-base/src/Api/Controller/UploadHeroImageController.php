<?php

/*
 * This file is part of ThemeBase.
 *
 * (c) Sami Mazouz <sychocouldy@gmail.com>
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Afrux\ThemeBase\Api\Controller;

use Flarum\Api\Controller\UploadImageController;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Psr\Http\Message\UploadedFileInterface;

class UploadHeroImageController extends UploadImageController
{
    protected $filePathSettingKey = 'afrux-theme-base.hero_banner';

    protected $filenamePrefix = 'afrux_banner';

    /**
     * {@inheritDoc}
     */
    protected function makeImage(UploadedFileInterface $file): Image
    {
        $manager = new ImageManager();

        $encodedImage = $manager->make($file->getStream())->encode('png');

        return $encodedImage;
    }
}
