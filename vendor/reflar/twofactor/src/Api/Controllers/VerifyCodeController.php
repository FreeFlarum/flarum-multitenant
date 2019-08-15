<?php

namespace Reflar\twofactor\Api\Controllers;

use Flarum\Api\Controller\AbstractShowController;
use Psr\Http\Message\ServerRequestInterface;
use Reflar\twofactor\TwoFactor;
use Tobscure\JsonApi\Document;

class VerifyCodeController extends AbstractShowController
{
    public $serializer = 'Reflar\twofactor\Api\Serializers\TwoFactorSerializer';

    /**
     * @var TwoFactor
     */
    private $twoFactor;

    /**
     * @param TwoFactor $twoFactor
     */
    public function __construct(TwoFactor $twoFactor)
    {
        $this->twoFactor = $twoFactor;
    }

    /**
     * @param ServerRequestInterface $request
     * @param Document               $document
     *
     * @throws \Twilio\Exceptions\ConfigurationException
     *
     * @return mixed|string
     */
    public function data(ServerRequestInterface $request, Document $document)
    {
        $data = $request->getParsedBody();
        $actor = $request->getAttribute('actor');

        $return = '';

        switch ($data['step']) {
            case 0:
                $actor->twofa_enabled = 0;
                $actor->save();
                break;
            case 1:
                $actor->twofa_enabled = 1;
                $return = $this->twoFactor->prepareTOTP2Factor($actor);
                $actor->save();
                break;
            case 2:
                if ($this->twoFactor->verifyTOTPCode($actor, $data['code'])) {
                    $return = $this->twoFactor->enable2Factor($actor, $data['step']);
                } else {
                    $return = 'IncorrectCode';
                }
                break;
            case 3:
                $this->twoFactor->preparePhone2Factor($actor, $data['phone']);
                break;
            case 4:
                if ($this->twoFactor->verifyPhoneCode($actor, strtoupper($data['code']))) {
                    $return = $this->twoFactor->enable2Factor($actor, $data['step']);
                } else {
                    $return = 'IncorrectCode';
                }
                break;
            case 5:
                $return = $this->twoFactor->prepareAuthy($actor, $data['countryCode'], $data['phone']);
                break;
            case 6:
                if ($this->twoFactor->verifyAuthyCode($actor, $data['code'])) {
                    $return = $this->twoFactor->enable2Factor($actor, $data['step']);
                } else {
                    $return = 'IncorrectCode';
                }
                break;

        }

        return $return;
    }
}
