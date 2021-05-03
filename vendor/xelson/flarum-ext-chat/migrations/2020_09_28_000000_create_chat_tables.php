<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
		$schema->rename('pushedx_messages', 'neonchat_messages');

		$schema->create('neonchat_chats', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100)->default('PM');
			$table->string('color', 20)->nullable();
			$table->string('icon', 100)->nullable();
			$table->tinyInteger('type')->default(0);
			$table->integer('creator_id')->unsigned()->default(0);
			$table->dateTime('created_at')->nullable();
		});

		$db = $schema->getConnection();
		$db->table('neonchat_chats')->insert([
			'title' => '#main',
			'color' => '#FF94C1',
			'icon' => 'fas fa-cloud',
			'type' => 1
		]);

		$schema->create('neonchat_chat_user', function (Blueprint $table) {
			$table->integer('chat_id')->unsigned();
			$table->integer('user_id')->unsigned();
	
			$table->primary(['chat_id', 'user_id']);
	
			$table->foreign('chat_id')->references('id')->on('neonchat_chats')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});

        $schema->table('neonchat_messages', function (Blueprint $table) {
			$table->integer('chat_id')->unsigned()->default(1);
			$table->renameColumn('actorId', 'user_id');
			$table->tinyInteger('type')->default(0);
			$table->boolean('is_readed')->default(0);
			$table->string('ip_address', 45)->nullable();
			
			$table->foreign('chat_id')->references('id')->on('neonchat_chats')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
    },
    'down' => function (Builder $schema) {
		$schema->rename('neonchat_messages', 'pushedx_messages');

		$schema->drop('neonchat_chats');
		$schema->drop('neonchat_chat_user');

        $schema->table('pushedx_messages', function (Blueprint $table) {
			$table->renameColumn('user_id', 'actorId');

        });
    }
];
