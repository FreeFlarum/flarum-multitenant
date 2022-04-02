# Passwordless login

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/clarkwinkelmann/flarum-ext-passwordless/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-passwordless.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-passwordless) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-passwordless.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-passwordless) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

This is a custom implementation of passwordless login for Flarum.

The login modal is turned into passwordless mode by default, but login via password is still possible via a link at the bottom of the modal.
Users are still able to set a password via the password change or password reset features.

By default login links are valid for 5 minutes.

The token present at the bottom of the email can also be used as a password until it expires.
This allows connecting into a different browser than the one that received the email.

Password becomes optional in the signup process and the password field is hidden by default.
A random password is generated when the field is left empty.

## Installation

    composer require clarkwinkelmann/flarum-ext-passwordless

## Support

This extension is under **active maintenance**.

Bugfixes and compatibility updates will be published for free as time allows.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features.

Support is offered on a "best effort" basis through the Flarum community thread.

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-passwordless)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-passwordless)
- [Discuss](https://discuss.flarum.org/d/22606)
