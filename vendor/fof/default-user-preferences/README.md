# Default User Preferences by FriendsOfFlarum

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/fof/default-user-preferences.svg)](https://packagist.org/packages/fof/default-user-preferences)

A [Flarum](http://flarum.org) extension.

Enables the following preferences by default for all new user signing up to your forum, with toggles in the extension settings to modify your chosen defaults.:

- 'Someone replies to one of my posts (email) notification'
- 'Someone mentions me in a post (email) notification'
- 'Follow after reply'

### Extending

Additional extensions may register defaults on the following way:

In your extension `extend.php`
```php
(new \FoF\DefaultUserPreferences\Extend\RegisterUserPreferenceDefault())
    ->register(THE PREFERENCE KEY, THE DEFAULT VALUE),
```

Be sure to include translations in the `fof-default-user-preferences.admin.settings` namespace with the key matching the `PREFERENCE KEY` provided in the extender above. For example:

`fof-default-user-preferences.admin.settings.myCoolKey`

### Installation

Install manually with composer:

```sh
composer require fof/default-user-preferences:"*"
```

### Updating

```sh
composer update fof/default-user-preferences
```

### Links

- [Packagist](https://packagist.org/packages/fof/default-user-preferences)
- [GitHub](https://github.com/FriendsOfFlarum/default-user-preferences)

An extension by [FriendsOfFlarum](https://github.com/FriendsOfFlarum).
