<?php

namespace Ziven\transferMoney\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;

class TransferMoneySerializer extends AbstractSerializer{
    protected $type = 'transferMoney';

    protected function getDefaultAttributes($data){
        $attributes = [
            'id' => $data->id,
            'from_user_id' => $data->from_user_id,
            'notes' => $data->notes,
            'target_user_id' => $data->target_user_id,
            'transfer_money_value' => $data->transfer_money_value,
            'assigned_at' => date("Y-m-d H:i:s", strtotime($data->assigned_at))
        ];

        return $attributes;
    }

    protected function fromUser($transferHistory){
        return $this->hasOne($transferHistory, BasicUserSerializer::class);
    }

    protected function targetUser($transferHistory){
        return $this->hasOne($transferHistory, BasicUserSerializer::class);
    }
}
