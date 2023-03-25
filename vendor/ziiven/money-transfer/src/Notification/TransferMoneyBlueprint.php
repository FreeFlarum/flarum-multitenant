<?php

namespace Ziven\transferMoney\Notification;

use Flarum\User\User;
use Ziven\transferMoney\Model\TransferMoney;
use Flarum\Notification\Blueprint\BlueprintInterface;

class TransferMoneyBlueprint implements BlueprintInterface{
    public $transferMoney;

    public function __construct(TransferMoney $transfer){
        $this->transferMoney = $transfer;
    }

    public function getSubject(){
        return $this->transferMoney;
    }

    public function getFromUser(){
        return $this->transferMoney->fromUser;
    }

    public function getData(){
        return null;
    }
    
    public static function getType(){
        return 'transferMoney';
    }

    public static function getSubjectModel(){
        return TransferMoney::class;
    }
}
