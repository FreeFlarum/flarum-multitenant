<?php


namespace Maicol07\SSO\User\Traits;

use GuzzleHttp\Exception\ClientException;
use RuntimeException;

/**
 * Trait Auth
 * @package Maicol07\SSO\Traits
 */
trait Auth
{
    /**
     * Logs the user in Flarum. Generally, you should use this method when an user successfully log into
     * your SSO system (or main website).
     *
     * @return bool
     */
    public function login(): bool
    {
        $r = $this->flarum->filter_hook('replace_login', null);
        if ($r !== -1) {
            return $r;
        }

        $this->flarum->action_hook('before_login');

        if (empty($this->attributes->password)) {
            throw new RuntimeException("User's password not set");
        }
        $token = $this->getToken();

        $this->flarum->action_hook('after_token_obtained', $token);

        // If no token has been returned...
        if (empty($token)) {
            // ...try to search the user...
            try {
                $this->flarum->api->users($this->attributes->username)->request();

                // Backward compatibility (create password based on username)
                $this->attributes->password = $this->createPassword();
                $token = $this->getToken();
                if (empty($token)) {
                    return false;
                }
            } catch (ClientException $e) {
                // ...otherwise signup it
                if ($e->getCode() === 404 and $e->getResponse()->getReasonPhrase() === "Not Found") {
                    $signed_up = $this->signup();
                    if (!$signed_up) {
                        return false;
                    }
                    $this->flarum->action_hook('after_signup');
                    $token = $this->getToken();
                } else {
                    throw $e;
                }
            }
        }

        $this->flarum->action_hook('after_login', $token);

        $deleted = $this->flarum->deleteLogoutCookie();
        $created = $this->flarum->isSessionRemembered() ? $this->flarum->setRememberTokenCookie($token) : $this->flarum->setSessionTokenCookie($token);

        return ($deleted and $created);
    }

    /**
     * Sign up user in Flarum. Generally, you should use this method when an user successfully log into
     * your SSO system (or main website) and you found out that user don't have a token (because he hasn't an account on Flarum)
     *
     * @return bool
     */
    public function signup(): bool
    {
        $r = $this->flarum->filter_hook('replace_signup', null);
        if ($r !== -1) {
            return $r;
        }

        $this->flarum->action_hook('before_signup');

        $data = [
            "type" => "users",
            "attributes" => $this->getAttributes()
        ];

        try {
            $user = $this->flarum->api->users()->post($data)->request();
            $this->flarum->action_hook('after_signup');
            return isset($user->id);
        } catch (ClientException $e) {
            if ($e->getResponse()->getReasonPhrase() === "Unprocessable Entity") {
                return false;
            }
            throw $e;
        }
    }

    /**
     * Generates a password based on username and password token
     *
     * @return string
     */
    private function createPassword(): string
    {
        return hash('sha256', $this->attributes->username . $this->flarum->password_token);
    }

    /**
     * Get user token from Flarum (if user exists)
     *
     * @return string
     */
    private function getToken(): ?string
    {
        $data = [
            'identification' => $this->attributes->username,
            'password' => $this->attributes->password,
            'remember' => $this->flarum->isSessionRemembered(),
        ];

        try {
            $response = $this->flarum->api->token()->post($data)->request();
            return $response->token ?? '';
        } catch (ClientException $e) {
            if ($e->getResponse()->getReasonPhrase() === "Unauthorized") {
                return null;
            }
            throw $e;
        }
    }
}
