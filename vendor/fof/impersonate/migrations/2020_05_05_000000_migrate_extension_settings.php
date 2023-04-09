<?php

/*
 * This file is part of fof/impersonate.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\Group\Permission;
use Illuminate\Database\Schema\Builder;

$permissionKey = 'fof-impersonate.login';

return [
    'up' => function (Builder $schema) use ($permissionKey) {
        $db = $schema->getConnection();
        $permission = $db->table('group_permission')
            ->where('permission', 'flagrow-impersonate.login');

        if (!Permission::query()->where('permission', $permissionKey)->exists()) {
            if ($permission->exists()) {
                $permission->update([
                    'permission' => $permissionKey,
                ]);
            }
        }
    },
    'down' => function (Builder $schema) use ($permissionKey) {
        $db = $schema->getConnection();

        $db->table('group_permission')->where('permission', $permissionKey)->delete();
    },
];
