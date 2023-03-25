<?php

namespace ClarkWinkelmann\MoneyRewards;

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
        $preselection = $this->settings->get('money-rewards.preselection');

        $attributes = [
            'moneyRewardsPreselection' => $preselection ? explode(',', $preselection) : [],
        ];

        if ($serializer->getActor()->hasPermission('money-rewards.customAmounts')) {
            $attributes['moneyRewardsCustomAmounts'] = true;
            $attributes['moneyRewardsCustomAmountsMin'] = max(0, (int)$this->settings->get('money-rewards.min'));
            $attributes['moneyRewardsCustomAmountsMax'] = ((int)$this->settings->get('money-rewards.max')) ?: null;
            $attributes['moneyRewardsCustomAmountsDecimals'] = max(0, (int)$this->settings->get('money-rewards.decimals'));
        }

        if ($serializer->getActor()->hasPermission('money-rewards.createMoney')) {
            $attributes['moneyRewardsCreateMoney'] = true;
        }

        return $attributes;
    }
}
