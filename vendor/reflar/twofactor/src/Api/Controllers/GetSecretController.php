<?php

namespace Reflar\twofactor\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Psr\Http\Message\ServerRequestInterface;
use Reflar\twofactor\TwoFactor;
use Tobscure\JsonApi\Document;

class GetSecretController extends AbstractListController
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
     * @throws \PragmaRX\Google2FA\Exceptions\InsecureCallException
     *
     * @return array|mixed
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = $request->getAttribute('actor');
        $url = $this->twoFactor->getURL($actor);

        return [
            $actor,
            $url,
        ];
    }
}
