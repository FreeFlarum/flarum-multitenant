<?php

namespace ClarkWinkelmann\MoneyToAll\Notifications;

use ClarkWinkelmann\MoneyToAll\Record;
use Flarum\Notification\Blueprint\BlueprintInterface;

class MoneyReceivedBlueprint implements BlueprintInterface
{
    protected $record;
    protected $amount;
    protected $message;

    public function __construct(Record $record, float $amount, string $message = null)
    {
        $this->record = $record;
        $this->amount = $amount;
        $this->message = $message;
    }

    public function getFromUser()
    {
        return null;
    }

    public function getSubject()
    {
        return $this->record;
    }

    public function getData()
    {
        return [
            'amount' => $this->amount,
            'message' => $this->message,
        ];
    }

    public static function getType()
    {
        return 'moneyToAll';
    }

    public static function getSubjectModel()
    {
        return Record::class;
    }
}
