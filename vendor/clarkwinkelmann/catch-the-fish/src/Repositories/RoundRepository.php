<?php

namespace ClarkWinkelmann\CatchTheFish\Repositories;

use Carbon\Carbon;
use ClarkWinkelmann\CatchTheFish\Round;
use ClarkWinkelmann\CatchTheFish\Validators\RoundValidator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class RoundRepository
{
    protected $validator;
    protected $fishRepository;
    protected $uploader;

    public function __construct(RoundValidator $validator, FishRepository $fishRepository, FishImageUploader $uploader)
    {
        $this->validator = $validator;
        $this->fishRepository = $fishRepository;
        $this->uploader = $uploader;
    }

    public function all()
    {
        return Round::all();
    }

    /**
     * @return Collection|Round[]
     */
    public function allActive(): Collection
    {
        return Round::activeRound()->get();
    }

    /**
     * @param $id
     * @return Model|Round
     * @throws ModelNotFoundException
     */
    public function findOrFail($id): Round
    {
        return Round::query()->where('id', $id)->firstOrFail();
    }

    protected function parseAttributes(array $attributes): array
    {
        $return = Arr::only($attributes, 'name');

        if (Arr::has($attributes, 'starts_at')) {
            $return['starts_at'] = Carbon::parse($attributes['starts_at']);
        }

        if (Arr::has($attributes, 'ends_at')) {
            $return['ends_at'] = Carbon::parse($attributes['ends_at']);
        }

        return $return;
    }

    /**
     * @param array $attributes
     * @return Round
     * @throws ValidationException
     * @throws \Flarum\Foundation\ValidationException
     */
    public function store(array $attributes): Round
    {
        $this->validator->assertValid($attributes);

        $round = new Round($this->parseAttributes($attributes));
        $round->save();

        if (Arr::get($attributes, 'include_starting_pack')) {
            $this->fishRepository->storeDefaultData($round);
        }

        return $round;
    }

    /**
     * @param Round $round
     * @param array $attributes
     * @return Round
     * @throws ValidationException
     */
    public function update(Round $round, array $attributes): Round
    {
        $this->validator->assertValid($attributes);

        $round->fill($this->parseAttributes($attributes));
        $round->save();

        return $round;
    }

    /**
     * @param Round $round
     * @throws \Exception
     */
    public function delete(Round $round): void
    {
        foreach ($round->fishes as $fish) {
            $this->uploader->remove($fish);
        }

        $round->delete();
    }
}
