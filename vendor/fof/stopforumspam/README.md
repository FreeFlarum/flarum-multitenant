# StopForumSpam by FriendsOfFlarum

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/fof/stopforumspam.svg)](https://packagist.org/packages/fof/stopforumspam) [![OpenCollective](https://img.shields.io/badge/opencollective-fof-blue.svg)](https://opencollective.com/fof/donate)

![Extiverse](https://extiverse.com/extension/fof/stopforumspam/open-graph-image)

A [Flarum](http://flarum.org) extension.

Checks new user registrations against the `StopForumSpam` database. If either the `confidence` or `frequency` thresholds are reached, the user is prevented from completing their registration on your forum. SSO register via `fof/oauth` and `fof/passport` is also supported. Other SSO providers should work, but are untested. 

### Installation

Install with composer:

```sh
composer require fof/stopforumspam:"*"
```

### Updating

```sh
composer update fof/stopforumspam
```

### Links

- [Extiverse](https://extiverse.com/extension/fof/stopforumspam)
- [Packagist](https://packagist.org/packages/fof/stopforumspam)
- [GitHub](https://github.com/FriendsOfFlarum/stopforumspam)

An extension by [FriendsOfFlarum](https://github.com/FriendsOfFlarum).
