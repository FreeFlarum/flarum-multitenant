<?php

namespace ClarkWinkelmann\CatchTheFish\Repositories;

use Carbon\Carbon;
use ClarkWinkelmann\CatchTheFish\Fish;
use ClarkWinkelmann\CatchTheFish\Round;
use ClarkWinkelmann\CatchTheFish\Validators\FishImageValidator;
use ClarkWinkelmann\CatchTheFish\Validators\FishValidator;
use Flarum\Foundation\Paths;
use Flarum\Locale\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Psr\Http\Message\UploadedFileInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FishRepository
{
    const BASE_IMAGES = [
        'pixabay-30828-640.png',
        'pixabay-30837-640.png',
        'pixabay-33712-640.png',
        'pixabay-36828-640.png',
        'pixabay-294469-640.png',
        'pixabay-1331813-640.png',
    ];

    protected $paths;
    protected $validator;
    protected $imageValidator;
    protected $uploader;
    protected $translator;

    public function __construct(Paths $paths, FishValidator $validator, FishImageValidator $imageValidator, FishImageUploader $uploader, Translator $translator)
    {
        $this->paths = $paths;
        $this->validator = $validator;
        $this->imageValidator = $imageValidator;
        $this->uploader = $uploader;
        $this->translator = $translator;
    }

    public function all(Round $round)
    {
        return $round->fishes;
    }

    /**
     * @param $id
     * @return Model|Fish
     * @throws ModelNotFoundException
     */
    public function findOrFail($id): Fish
    {
        return Fish::query()->where('id', $id)->firstOrFail();
    }

    /**
     * @param Round $round
     * @param array $attributes
     * @return Fish
     * @throws ValidationException
     * @throws \Flarum\Foundation\ValidationException
     */
    public function store(Round $round, array $attributes): Fish
    {
        $this->validator->assertValid($attributes);

        $fish = new Fish($attributes);
        $fish->round()->associate($round);
        Placement::random()->assign($fish);
        $fish->placement_valid_since = Carbon::now();
        $fish->save();

        return $fish;
    }

    /**
     * @param Fish $fish
     * @param array $attributes
     * @return Fish
     * @throws ValidationException
     */
    public function update(Fish $fish, array $attributes): Fish
    {
        $this->validator->assertValid($attributes);

        if (Arr::has($attributes, 'name')) {
            // Remove the link to the last user who renamed the fish if an admin renames it via the admin panel
            $fish->user_id_last_naming = null;
        }

        $fish->fill($attributes);
        $fish->save();

        return $fish;
    }

    /**
     * @param Fish $fish
     * @param UploadedFileInterface $file
     * @return Fish
     * @throws ValidationException
     */
    public function updateImage(Fish $fish, UploadedFileInterface $file): Fish
    {
        $tmpFile = tempnam($this->paths->storage . '/tmp', 'catch-the-fish');
        $file->moveTo($tmpFile);

        try {
            $file = new UploadedFile(
                $tmpFile,
                $file->getClientFilename(),
                $file->getClientMediaType(),
                $file->getError(),
                true
            );

            $this->imageValidator->assertValid(['image' => $file]);

            $image = $this->imageManager()->make($tmpFile);

            $this->uploader->upload($fish, $image);

            $fish->save();
        } finally {
            @unlink($tmpFile);
        }

        return $fish;
    }

    /**
     * @param Round $round
     * @param UploadedFileInterface[] $files
     * @return Fish[]
     */
    public function bulkImageImport(Round $round, array $files): array
    {
        $filesToUnlink = [];

        $originalNames = [];

        try {
            return collect($files)->map(function (UploadedFileInterface $file, $index) use (&$filesToUnlink, &$originalNames) {
                // First we check and load all files
                $tmpFile = tempnam($this->paths->storage . '/tmp', 'catch-the-fish');
                $file->moveTo($tmpFile);
                $filesToUnlink[] = $tmpFile;

                $originalNames[$index] = $file->getClientFilename();

                $file = new UploadedFile(
                    $tmpFile,
                    $file->getClientFilename(),
                    $file->getClientMediaType(),
                    $file->getError(),
                    true
                );

                $this->imageValidator->assertValid(['image' => $file]);

                return $this->imageManager()->make($tmpFile);
            })->map(function (Image $image, $index) use ($originalNames, $round) {
                // Then we create the fishes and save the images
                $fish = new Fish();

                $this->uploader->upload($fish, $image);

                $fish->name = explode('.', $originalNames[$index])[0];
                $fish->round()->associate($round);
                Placement::random()->assign($fish);
                $fish->placement_valid_since = Carbon::now();
                $fish->save();

                return $fish;
            })->all();
        } finally {
            foreach ($filesToUnlink as $tmpFile) {
                @unlink($tmpFile);
            }
        }
    }

    /**
     * @param Fish $fish
     * @throws \Exception
     */
    public function delete(Fish $fish): void
    {
        $this->uploader->remove($fish);

        $fish->delete();
    }

    /**
     * @param Round $round
     * @throws \Flarum\Foundation\ValidationException
     */
    public function storeDefaultData(Round $round): void
    {
        $now = Carbon::now();

        foreach (self::BASE_IMAGES as $index => $originalImagePath) {
            $fish = new Fish();

            $image = $this->imageManager()->make(__DIR__ . '/../../resources/images/' . $originalImagePath);
            $this->uploader->upload($fish, $image);

            $fish->round_id = $round->id;
            $fish->name = $this->translator->trans('clarkwinkelmann-catch-the-fish.api.default-fish-name', [
                '{number}' => $index + 1,
            ]);
            Placement::random()->assign($fish);
            $fish->placement_valid_since = $now;
            $fish->save();
        }
    }

    /**
     * Resolve Intervention Image manager from container so Flarum picks driver between GD or Imagick
     * @return ImageManager
     */
    protected function imageManager(): ImageManager
    {
        return resolve(ImageManager::class);
    }
}
