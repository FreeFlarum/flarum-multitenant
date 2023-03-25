# Pretty Mail by FriendsOfFlarum

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/fof/pretty-mail.svg)](https://packagist.org/packages/fof/pretty-mail) [![OpenCollective](https://img.shields.io/badge/opencollective-fof-blue.svg)](https://opencollective.com/fof/donate)

A [Flarum](http://flarum.org) extension. Make custom HTML templates for emails!

- Configure your custom email template from the extension settings
- This supports all emails sent by Flarum, and 3rd party extensions

### Extending

It is possible to make additional variables available to the templates from other extensions. For example:

In your `extend.php`
```php
(new \FoF\PrettyMail\Extend\PrettyMail)
    ->addTemplateData('myNewVariable', Callback\NewVariableCallback::class),
```

The callback should be an invokable class, and accept `\Flarum\Notification\Blueprint\BlueprintInterface`, returning the `string` value that should be assigned to your new variable.

You should also include a translation using the key `fof-pretty-mail.admin.settings.attributes.myNewVariable`, which will be displayed in the extension settings page, so that admin users know what your new key is providing them, and were they should use it in their template.

### Installation

Install with composer:

```sh
composer require fof/pretty-mail:"*"
```

### Updating

```sh
composer update fof/pretty-mail
```

### Important Note 

Due to how Flarum handles certain emails, I had to utilize a "hack" to get it to work. Please report any issues you have to our Github.

### Links

[<img src="https://opencollective.com/fof/donate/button@2x.png?color=blue" height="25" />](https://opencollective.com/fof/donate)

- [Packagist](https://packagist.org/packages/fof/pretty-mail)
- [GitHub](https://github.com/packages/FriendsOfFlarum/pretty-mail)

An extension by [FriendsOfFlarum](https://github.com/FriendsOfFlarum).
