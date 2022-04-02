<?php

use ClarkWinkelmann\CatchTheFish\Ranking;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        // Merge any duplicate ranking that might exist in the database
        $schema->getConnection()->table('catchthefish_rankings')
            ->selectRaw('round_id, user_id, sum(catch_count) as catch_count_sum')
            ->orderBy('round_id')
            ->orderBy('user_id')
            ->groupBy('round_id', 'user_id')->each(function ($duplicate) {
                $first = Ranking::query()
                    ->where('round_id', $duplicate->round_id)
                    ->where('user_id', $duplicate->user_id)
                    ->first();

                $first->catch_count = $duplicate->catch_count_sum;
                $first->save();

                Ranking::query()
                    ->where('round_id', $duplicate->round_id)
                    ->where('user_id', $duplicate->user_id)
                    ->where('id', '!=', $first->id)
                    ->delete();
            });

        // Add missing unique constraint
        $schema->table('catchthefish_rankings', function (Blueprint $table) {
            $table->unique(['round_id', 'user_id']);
        });
    },
    'down' => function (Builder $schema) {
        // Not implemented because in Flarum you can't revert just one migration
        // And it causes an error with the foreign key indexes
    },
];
