<?php

namespace Ziven\transferMoney\Controller;

use Ziven\transferMoney\Serializer\TransferMoneySerializer;
use Ziven\transferMoney\Model\TransferMoney;
use Ziven\transferMoney\Notification\TransferMoneyBlueprint;

use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Api\Controller\AbstractCreateController;
use Flarum\User\User;
use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use Flarum\Notification\NotificationSyncer;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Illuminate\Support\Carbon;

class TransferMoneyController extends AbstractCreateController{
    public $serializer = TransferMoneySerializer::class;
    protected $settings;
    protected $notifications;
    protected $translator;

    public function __construct(NotificationSyncer $notifications, Translator $translator,SettingsRepositoryInterface $settings){
        $this->settings = $settings;
        $this->notifications = $notifications;
        $this->translator = $translator;
    }

    protected function data(ServerRequestInterface $request, Document $document){
        $requestData = $request->getParsedBody()['data']['attributes'];
        $moneyTransfer = floatval($requestData['moneyTransfer']);
        $moneyTransferNotes = trim($requestData['moneyTransferNotes']);
        $selectedUsers = json_decode($requestData['selectedUsers']);
        $moneyTransferTotalUser = count($selectedUsers);
        $currentUserID = $request->getAttribute('actor')->id;
        $errorMessage = "";

        if(!isset($moneyTransfer) || array_search($currentUserID, $selectedUsers)!==false || $moneyTransfer<=0 || $moneyTransferTotalUser===0){
            $errorMessage = 'ziven-transfer-money.forum.transfer-error';
        }else{
            $currentUserData = User::find($currentUserID);
            $allowUseTranferMoney = $request->getAttribute('actor')->can('transferMoney.allowUseTranferMoney', $currentUserData);

            if($allowUseTranferMoney){
                $currentUserMoneyRemain = $currentUserData->money-($moneyTransfer*$moneyTransferTotalUser);
                $selectedUsersDataCount = User::find($selectedUsers)->count();

                if($selectedUsersDataCount===$moneyTransferTotalUser){
                    if($currentUserMoneyRemain<0){
                        $errorMessage = 'ziven-transfer-money.forum.transfer-error-insufficient-fund';
                    }else{
                        $defaultTimezone = 'Asia/Shanghai';
                        $settingTimezone = $this->settings->get('moneyTransfer.moneyTransferTimeZone', $defaultTimezone);

                        if(!in_array($settingTimezone, timezone_identifiers_list())) {
                            $settingTimezone = $defaultTimezone;
                        }

                        $currentUserData->money = $currentUserMoneyRemain;
                        $currentUserData->save();

                        foreach($selectedUsers as $targetUserID) {
                            $transferMoney = new TransferMoney();
                            $transferMoney->from_user_id = $currentUserID;
                            $transferMoney->target_user_id = $targetUserID;
                            $transferMoney->transfer_money_value = $moneyTransfer;
                            $transferMoney->assigned_at = Carbon::now($settingTimezone);

                            if(!empty($moneyTransferNotes)){
                                $transferMoney->notes = $moneyTransferNotes;
                            }

                            $transferMoney->save();

                            $targetUserData = User::find($targetUserID);
                            $targetUserData->money+=$moneyTransfer;
                            $targetUserData->save();

                            $this->notifications->sync(new TransferMoneyBlueprint($transferMoney),[$targetUserData]);
                        }

                        return $currentUserData;
                    }
                }else{
                    $errorMessage = 'ziven-transfer-money.forum.transfer-error';
                }
            }else{
                $errorMessage = 'ziven-transfer-money.forum.transfer-error-no-permission';
            }
        }

        if($errorMessage!==""){
            throw new ValidationException(['message' => $this->translator->trans($errorMessage)]); 
        }
    }
}
