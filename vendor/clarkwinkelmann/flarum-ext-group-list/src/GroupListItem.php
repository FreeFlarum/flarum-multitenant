<?php

namespace ClarkWinkelmann\GroupList;

use Flarum\Database\AbstractModel;
use Flarum\Group\Group;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Relations;

/**
 * @property int $id
 * @property int $group_id
 * @property string $content
 * @property int $order
 *
 * @property Group $group
 */
class GroupListItem extends AbstractModel
{
    protected $table = 'clarkwinkelmann_group_list';

    public function group(): Relations\BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function members(): Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id', 'group_id')
            ->orderBy('username');
    }
}
