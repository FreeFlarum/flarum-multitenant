# Likes Received

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/clarkwinkelmann/flarum-ext-likes-received/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-likes-received.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-likes-received) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-likes-received.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-likes-received) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

Shows the total number of likes received on a user profile.

A permission controls who can see the number of likes of other users.

For performance reasons, the counter is simply incremented or decremented upon a new like or unlike.
This means the actual number of likes could be off if you disable the extension, edit likes data directly in the database or if an exception occurs in another extension during a like event.

You can fix the number of likes received for all existing users with the following command.
Depending on your number of users it could take a few seconds to complete.

    php flarum clarkwinkelmann:likes-received:refresh

You can use this command after the installation to import existing likes count as well.

## Installation

    composer require clarkwinkelmann/flarum-ext-likes-received

## Support

This extension is under **minimal maintenance**.

It was developed for a client and released as open-source for the benefit of the community.
I might publish simple bugfixes or compatibility updates for free.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features or updates.

Support is offered on a "best effort" basis through the Flarum community thread.

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-likes-received)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-likes-received)
- [Discuss](https://discuss.flarum.org/d/24489)
