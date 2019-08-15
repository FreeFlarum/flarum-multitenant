<?php

namespace Reflar\twofactor;

use Authy\AuthyApi as AuthyApi;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use PragmaRX\Google2FA\Google2FA;
use Reflar\twofactor\Events\UserEnabledTwoFactor;
use Symfony\Component\Translation\TranslatorInterface;
use Twilio\Rest\Client as TwillioClient;

class TwoFactor
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var Google2FA
     */
    protected $google2fa;

    /**
     * @var Hasher
     */
    protected $hasher;

    /**
     * @var MAiler
     */
    protected $mailer;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * @var AuthyApi
     */
    protected $authy;

    /**
     * TwoFactor constructor.
     *
     * @param SettingsRepositoryInterface $settings
     * @param Google2FA                   $google2fa
     * @param Hasher                      $hasher
     * @param Mailer                      $mailer
     * @param TranslatorInterface         $translator
     * @param Dispatcher                  $events
     */
    public function __construct(
        SettingsRepositoryInterface $settings,
        Google2FA $google2fa,
        Hasher $hasher,
        Mailer $mailer,
        TranslatorInterface $translator,
        Dispatcher $events
    ) {
        $this->google2fa = $google2fa;
        $this->settings = $settings;
        $this->hasher = $hasher;
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->events = $events;
        $this->authy = new AuthyApi($this->settings->get('reflar.twofactor.authy_api_key'));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function prepareTOTP2Factor($user)
    {
        $user->google2fa_secret = $this->google2fa->setEnforceGoogleAuthenticatorCompatibility(true)->generateSecretKey(16);
        $user->save();

        return $user;
    }

    /**
     * @param $user
     * @param $case
     *
     * @return string
     */
    public function enable2Factor($user, $case)
    {
        $user->twofa_enabled = $case;
        $recoveryCodes = $this->generateRecoveryCodes();

        $codes = explode(',', $recoveryCodes);

        foreach ($codes as &$code) {
            $code = $this->hasher->make($code);
        }

        $user->recovery_codes = implode(',', $codes);

        $user->save();

        $this->events->dispatch(new UserEnabledTwoFactor($user));

        $this->notifyEnabled($user);

        return $recoveryCodes;
    }

    /**
     * @param $user
     */
    public function disable2Factor($user)
    {
        $user->google2fa_secret = '';
        $user->twofa_enabled = 0;
        $user->recovery_codes = '';
        $user->phone = '';
        $user->carrier = '';
        $user->save();
    }

    /**
     * @param $user
     *
     * @throws \PragmaRX\Google2FA\Exceptions\InsecureCallException
     *
     * @return string
     */
    public function getURL($user)
    {
        return $this->google2fa->setAllowInsecureCallToGoogleApis(true)->getQRCodeGoogleUrl($this->settings->get('forum_title'), $user->username, $user->google2fa_secret);
    }

    /**
     * @return string
     */
    public function generateRandom6String()
    {
        $randst = '';
        $chars = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'J',
            'K',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z',
        ];
        for ($rand = 0; $rand < 7; $rand++) {
            $random = rand(0, count($chars) - 1);
            if (3 == $rand) {
                $randst .= '-';
            } else {
                $randst .= $chars[$random];
            }
        }

        return $randst;
    }

    /**
     * @return string
     */
    public function generateRecoveryCodes()
    {
        $randstr = '';
        for ($i = 0; $i < 3; $i++) {
            $randstr .= $this->generateRandom6String();
            if (2 !== $i) {
                $randstr .= ',';
            }
        }

        return $randstr;
    }

    /**
     * @param $user
     * @param $phone
     *
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function preparePhone2Factor($user, $phone)
    {
        $user->phone = $phone;
        $user->twofa_enabled = 3;

        $this->sendText($user);

        $user->save();
    }

    /**
     * @param $user
     * @param $countryCode
     * @param $phone
     *
     * @return bool
     */
    public function prepareAuthy($user, $countryCode, $phone)
    {
        $authyUser = $this->authy->registerUser($user->email, $phone, $countryCode);

        if ($authyUser->ok()) {
            $user->twofa_enabled = 5;
            $user->authy_id = $authyUser->id();
            $user->save();

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $code
     * @param $user
     *
     * @return bool
     */
    public function doRecovery($code, $user)
    {
        $code = strtoupper($code);
        $codes = explode(',', $user->recovery_codes);

        $return = false;
        for ($i = 0; $i < count($codes); $i++) {
            if ($this->hasher->check($code, $codes[$i])) {
                unset($codes[$i]);
                $return = true;
                break;
            }
        }
        $user->recovery_codes = implode(',', $codes);
        $user->save();

        return $return;
    }

    /**
     * @param $user
     * @param $input
     *
     * @return bool
     */
    public function verifyTOTPCode($user, $input)
    {
        if ($this->google2fa->verifyKey($user->google2fa_secret, str_replace('-', '', $input))) {
            $return = true;
        } else {
            $return = $this->doRecovery($input, $user);
        }

        return $return;
    }

    /**
     * @param $user
     * @param $input
     *
     * @return bool
     */
    public function verifyPhoneCode($user, $input)
    {
        if ($this->hasher->check($input, $user->text_code)) {
            $return = true;
        } else {
            $return = $this->doRecovery($input, $user);
        }

        return $return;
    }

    public function verifyAuthyCode($user, $input)
    {
        $input = (empty($input) || strlen($input) > 8 || strlen($input) < 6) ? '000000' : $input;

        if ($this->doRecovery($input, $user)) {
            return true;
        } elseif (is_numeric($input) && $this->authy->verifyToken($user->authy_id, $input)->ok()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $user
     */
    public function sendOneTouch($user)
    {
        if ($user->authy_status !== 'unverified') {
            $user->authy_status = 'unverified';
            $user->save();
        }

        $oneTouchApproval = $this->authy->createApprovalRequest($user->authy_id, $this->translator->trans('reflar-twofactor.forum.onetouch', [
            '{forum}' => $this->settings->get('forum_title'),
        ]), [
            'details[Username]' => $user->username,
            'details[Email]'    => $user->email,

        ]);

        if ($oneTouchApproval->ok()) {
            $user->authy_uuid = $oneTouchApproval->bodyvar('approval_request')->uuid;
            $user->save();
        }
    }

    /**
     * @param $user
     *
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function sendText($user)
    {
        $sid = $this->settings->get('reflar.twofactor.twillio_sid');
        $token = $this->settings->get('reflar.twofactor.twillio_token');
        $client = new TwillioClient($sid, $token);

        $randst = $this->generateRandom6String();
        $user->text_code = $this->hasher->make($randst);

        $user->save();

        $client->messages->create($user->phone, [
            'from' => $this->settings->get('reflar.twofactor.twillio_number'),
            'body' => $this->translator->trans('reflar-twofactor.forum.text', [
                '{forum}' => $this->settings->get('forum_title'),
                '{code}'  => $randst,
            ]),
        ]);
    }

    /**
     * @param $user
     */
    public function notifyEnabled($user)
    {
        $this->mailer->raw($this->translator->trans('reflar-twofactor.forum.email.body'), function (Message $message
        ) use ($user) {
            $message->to($user->email);
            $message->subject('['.$this->settings->get('forum_title').'] '.$this->translator->trans('reflar-twofactor.forum.email.subject'));
        });
    }
}
