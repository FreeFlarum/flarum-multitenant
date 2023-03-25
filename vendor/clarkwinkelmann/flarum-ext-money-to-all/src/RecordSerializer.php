<?php

namespace ClarkWinkelmann\MoneyToAll;

use Flarum\Api\Serializer\AbstractSerializer;

class RecordSerializer extends AbstractSerializer
{
    protected $type = 'moneyToAll';

    protected function getDefaultAttributes($model): array
    {
        return [];
    }
}
