<?php

namespace ClarkWinkelmann\MoneyRewards;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Serializer\UserSerializer;

class RewardSerializer extends AbstractSerializer
{
    protected $type = 'money-rewards';

    /**
     * @param Reward $reward
     * @return array
     */
    protected function getDefaultAttributes($reward): array
    {
        return [
            'amount' => $reward->amount,
            'new_money' => $reward->new_money,
            'comment' => $reward->comment,
            'createdAt' => $this->formatDate($reward->created_at),
        ];
    }

    public function post($reward)
    {
        return $this->hasOne($reward, BasicPostSerializer::class);
    }

    public function giver($reward)
    {
        return $this->hasOne($reward, BasicUserSerializer::class);
    }

    public function receiver($reward)
    {
        return $this->hasOne($reward, BasicUserSerializer::class);
    }

    public function fullGiver($reward)
    {
        // Same relation but with complete serializer to refresh user profile
        return $this->hasOne($reward, UserSerializer::class, 'giver');
    }

    public function fullReceiver($reward)
    {
        return $this->hasOne($reward, UserSerializer::class, 'receiver');
    }
}
