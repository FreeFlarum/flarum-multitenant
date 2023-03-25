<?php


namespace Maicol07\SSO\Traits;

use Delight\Cookie\Cookie;
use Illuminate\Support\Carbon;

trait Cookies
{
    public function setRememberTokenCookie(string $token): bool
    {
        return $this->generateCookie('remember', $token, Carbon::now()->addYears(5))->saveAndSet();
    }

    /**
     * Generate a cookie
     *
     * @param string $name
     * @param string|null $value
     * @param Carbon|null $expiry
     *
     * @return Cookie
     *
     * @noinspection CallableParameterUseCaseInTypeContextInspection
     */
    public function generateCookie(string $name, string $value = null, Carbon $expiry = null): Cookie
    {
        if ($expiry === null) {
            $expiry = Carbon::now();
        }

        return (new Cookie("{$this->cookies_prefix}_$name"))
            ->setDomain($this->root_domain)
            ->setSecureOnly($this->verify)
            ->setValue($value)
            ->setExpiryTime($expiry->getTimestamp());
    }

    public function deleteRememberTokenCookie(): bool
    {
        return $this->generateCookie('remember')->deleteAndUnset();
    }

    public function setSessionTokenCookie(string $token): bool
    {
        return $this->generateCookie('token', $token, Carbon::now()->addHour())->saveAndSet();
    }

    public function deleteSessionTokenCookie(): bool
    {
        return $this->generateCookie('token')->deleteAndUnset();
    }

    public function setLogoutCookie(): bool
    {
        return $this->generateCookie('logout', 'flarum_logout', Carbon::now()->addYears(5))
            ->saveAndSet();
    }

    public function deleteLogoutCookie(): bool
    {
        return $this->generateCookie('logout')->deleteAndUnset();
    }
}
