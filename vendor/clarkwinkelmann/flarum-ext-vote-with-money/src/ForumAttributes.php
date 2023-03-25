<?php

namespace ClarkWinkelmann\VoteWithMoney;

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
        $preselection = $this->settings->get('vote-with-money.preselection');

        return [
            'moneyVotePreselection' => $preselection ? explode(',', $preselection) : [],
        ];
    }
}
