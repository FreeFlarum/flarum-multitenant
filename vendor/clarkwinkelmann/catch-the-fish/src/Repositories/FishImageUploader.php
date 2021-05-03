<?php

namespace ClarkWinkelmann\CatchTheFish\Repositories;

use ClarkWinkelmann\CatchTheFish\Fish;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Image;
use League\Flysystem\FilesystemInterface;

class FishImageUploader
{
    protected $assets;

    public function __construct(FilesystemInterface $assets)
    {
        $this->assets = $assets;
    }

    public function upload(Fish $fish, Image $image)
    {
        if (extension_loaded('exif')) {
            $image->orientate();
        }

        $encodedImage = $image->resize(300, 200, function (Constraint $size) {
            $size->aspectRatio();
            $size->upsize();
        })->encode('png');

        $imagePath = Str::random() . '.png';

        $this->remove($fish);
        $fish->image = $imagePath;

        $this->assets->put($imagePath, $encodedImage);
    }

    public function remove(Fish $fish)
    {
        $imagePath = $fish->image;

        if ($this->assets->has($imagePath)) {
            $this->assets->delete($imagePath);
        }

        $fish->image = null;
    }
}
