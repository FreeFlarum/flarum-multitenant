# Lite YouTube Embed

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/sycho/flarum-lite-youtube.svg)](https://packagist.org/packages/sycho/flarum-lite-youtube) [![Total Downloads](https://img.shields.io/packagist/dt/sycho/flarum-lite-youtube.svg)](https://packagist.org/packages/sycho/flarum-lite-youtube)

A [Flarum](http://flarum.org) extension.

Replaces iframe YouTube embeds from [`fof/formatting`](https://github.com/FriendsOfFlarum/formatting) with a lightweight embed implementation using [`lite-youtube`](https://github.com/justinribeiro/lite-youtube).

The `MediaEmbed` option in `fof/formatting` must be enabled for this extension to work.

## Installation

Install with composer:

```sh
composer require sycho/flarum-lite-youtube:"*"
```

## Updating

```sh
composer update sycho/flarum-lite-youtube:"*"
php flarum migrate
php flarum cache:clear
```

## Support
This extension is under minimal maintenance.

It was developed for a client and released as open-source for the benefit of the community.
I might publish simple bugfixes or compatibility updates for free.

## Links

- [Packagist](https://packagist.org/packages/sycho/flarum-lite-youtube)
- [GitHub](https://github.com/SychO9/flarum-lite-youtube)
- [Discuss](https://discuss.flarum.org/d/31817-lite-youtube-embed/5)
