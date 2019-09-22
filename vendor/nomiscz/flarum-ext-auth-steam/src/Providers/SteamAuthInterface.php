<?php

/*
 * This file is part of nomiscz/flarum-ext-auth-steam.
 *
 * Copyright (c) 2019 NomisCZ.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace NomisCZ\SteamAuth\Providers;

use Illuminate\Support\Fluent;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class SteamAuth
 * @package NomisCZ\SteamAuth
 * @author NomisCZ | Original: Nikita Brytkov (invisnik)
 */
interface SteamAuthInterface
{
    /**
     * @param Request $request
     */
    public function setRequest(Request $request) : void;

    /**
     * @return RedirectResponse
     */
    public function redirect() : RedirectResponse;

    /**
     * @return bool
     */
    public function validate() : bool;

    /**
     * @return string
     */
    public function getSteamId() : string;

    /**
     * @return Fluent
     */
    public function getUserInfo() : Fluent;
}