# Custom HTML Error Pages by FriendsOfFlarum


![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/fof/html-errors.svg)](https://packagist.org/packages/fof/html-errors) [![OpenCollective](https://img.shields.io/badge/opencollective-fof-blue.svg)](https://opencollective.com/fof/donate)

This extension allows you to customize the Flarum error pages.
By default these pages have only limited styling in Flarum.
Now you can change them to something that better reflects your website!

## Installation

Use Bazaar or install it with Composer:

```
composer require fof/html-errors
```

## Updating

```
composer update fof/html-errors
```

## Configuration

Open the extension options to configure the custom HTML.
Leaving a field empty will show the default Flarum error page.

The custom error pages are only applied when browsing the forum front-end.
Any error response under /api or /admin is unaffected.

The custom error pages are not shown when debug mode is on.

You can handle additional error codes by entering the values manually in the `settings` table of the database.

## Links

[![OpenCollective](https://img.shields.io/badge/donate-friendsofflarum-44AEE5?style=for-the-badge&logo=open-collective)](https://opencollective.com/fof/donate)

- [Flarum Discuss post](https://discuss.flarum.org/d/10784)
- [Packagist](https://packagist.org/packages/fof/html-errors)
- [GitHub](https://github.com/FriendsOfFlarum/html-errors)

An extension by [FriendsOfFlarum](https://github.com/FriendsOfFlarum).
