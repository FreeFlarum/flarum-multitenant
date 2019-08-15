<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('users', function (Blueprint $table) {
            $table->string('authy_id');
            $table->string('authy_status');
            $table->string('authy_uuid');
        });
    },
  'down' => function (Builder $schema) {
      $schema->table('users', function (Blueprint $table) {
          $table->dropColumn('authy_status');
          $table->dropColumn('authy_id');
          $table->dropColumn('authy_uuid');
      });
  },
];
