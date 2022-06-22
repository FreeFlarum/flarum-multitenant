<?php

namespace ClarkWinkelmann\CatchTheFish\Serializers;

use ClarkWinkelmann\CatchTheFish\Ranking;
use ClarkWinkelmann\CatchTheFish\Round;
use Flarum\Api\Serializer\AbstractSerializer;
use Tobscure\JsonApi\Relationship;
use Tobscure\JsonApi\Resource;

class RoundSerializer extends AbstractSerializer
{
    protected $type = 'catchthefish-rounds';

    /**
     * @param Round $round
     * @return array
     */
    protected function getDefaultAttributes($round): array
    {
        /**
         * @var $ranking Ranking
         */
        $ranking = $round->userRanking($this->actor);

        return [
            'name' => $round->name,
            'starts_at' => $this->formatDate($round->starts_at),
            'ends_at' => $this->formatDate($round->ends_at),
            'my_catch_count' => $ranking ? $ranking->catch_count : 0,
        ];
    }

    public function myRanking(Round $round): ?Relationship
    {
        $data = $round->userRanking($this->actor);

        return new Relationship(new Resource($data, $this->resolveSerializer(RankingSerializer::class, $round, $data)));
    }
}
