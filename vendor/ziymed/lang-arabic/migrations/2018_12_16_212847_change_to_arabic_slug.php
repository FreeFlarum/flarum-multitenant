<?php

use Ziymed\LangArabic\Util\Str;
use Flarum\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        // Store slugs for existing discussions
        $schema->getConnection()->table('discussions')->orderBy('id')->chunk(100, function ($discussions) use ($schema) {
            foreach ($discussions as $discussion) {
                $schema->getConnection()->table('discussions')->where('id', $discussion->id)->update([
                    'slug' => Str::slug($discussion->title)
                ]);
            }
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('discussions', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
];