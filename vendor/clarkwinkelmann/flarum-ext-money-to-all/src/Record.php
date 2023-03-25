<?php

namespace ClarkWinkelmann\MoneyToAll;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class Record extends AbstractModel
{
    protected $table = 'money_to_all';

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
