<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasColumn('users', 'twofa_enabled')) {
            $schema->table('users', function (Blueprint $table) {
                $table->boolean('twofa_enabled')->default(0);
                $table->string('google2fa_secret');
                $table->string('recovery_codes')->nullable;
            });
        }
        $schema->table('users', function (Blueprint $table) {
            $table->string('phone');
            $table->string('text_code');
            $table->string('pageId');
        });
    },
  'down' => function (Builder $schema) {
      $schema->table('users', function (Blueprint $table) {
          $table->dropColumn('google2fa_secret');
          $table->dropColumn('twofa_enabled');
          $table->dropColumn('recovery_codes');
          $table->dropColumn('phone');
          $table->dropColumn('text_code');
          $table->dropColumn('carrier');
      });
  },
  ];
