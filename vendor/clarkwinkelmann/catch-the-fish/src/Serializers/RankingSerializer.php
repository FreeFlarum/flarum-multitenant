<?php

namespace ClarkWinkelmann\CatchTheFish\Serializers;

use ClarkWinkelmann\CatchTheFish\Ranking;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\UserSerializer;

class RankingSerializer extends AbstractSerializer
{
    protected $type = 'catchthefish-rankings';

    /**
     * @param Ranking $ranking
     * @return array
     */
    protected function getDefaultAttributes($ranking)
    {
        return [
            'catch_count' => $ranking->catch_count,
        ];
    }

    /**
     * @param Ranking $ranking
     * @return \Tobscure\JsonApi\Relationship
     */
    public function user($ranking)
    {
        return $this->hasOne($ranking, UserSerializer::class, 'user');
    }
}
