<?php

namespace ClarkWinkelmann\CatchTheFish;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Settings\SettingsRepositoryInterface;

class ForumAttributes
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(ForumSerializer $serializer): array
    {
        return [
            'catchTheFishCanModerate' => $serializer->getActor()->can('catchthefish.moderate'),
            'catchTheFishCanSeeRankingsPage' => $serializer->getActor()->can('catchthefish.list-rankings'),
            'catchTheFishAnimateFlip' => (bool)$this->settings->get('catch-the-fish.animateFlip', true),
        ];
    }
}
