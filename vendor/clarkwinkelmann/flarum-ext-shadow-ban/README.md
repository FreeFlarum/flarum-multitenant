# Shadow Ban

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/clarkwinkelmann/flarum-ext-shadow-ban/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-shadow-ban.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-shadow-ban) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-shadow-ban.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-shadow-ban) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

This extension implements shadow ban and content deletion for Flarum.

When a discussion or post is shadow hidden, only the author and users with permission "Shadow hide discussions and posts" will see it.

A user can be shadow banned for a given duration via their profile.
When a user is shadow banned, all their new discussions and posts are automatically shadow hidden.
They are **not restored** when the shadow ban ends.

Optionally you can enable the users to be shadow hidden when shadow banned.
When a user is shadow hidden, their profile will no longer be accessible by direct link and they won't be offered in search and mention auto-completion.

## Installation

    composer require clarkwinkelmann/flarum-ext-shadow-ban

## Support

This extension is under **active maintenance**.

Bugfixes and compatibility updates will be published for free as time allows.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features.

Support is offered on a "best effort" basis through the Flarum community thread.

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-shadow-ban)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-shadow-ban)
- [Discuss](https://discuss.flarum.org/d/27555)
