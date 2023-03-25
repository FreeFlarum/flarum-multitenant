<?php

namespace Ziven\transferMoney\Model;

use Flarum\Database\AbstractModel;
use Flarum\Database\ScopeVisibilityTrait;
use Flarum\User\User;

class TransferMoney extends AbstractModel{
    use ScopeVisibilityTrait;
    protected $table = 'ziven_transfer_money';
    
    public function fromUser(){
        return $this->hasOne(User::class, 'id', 'from_user_id');
    }

    public function targetUser(){
        return $this->hasOne(User::class, 'id', 'target_user_id');
    }
}
