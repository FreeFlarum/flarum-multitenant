# Blomstra Font Awesome 6

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/blomstra/fontawesome.svg)](https://packagist.org/packages/blomstra/fontawesome) [![Total Downloads](https://img.shields.io/packagist/dt/blomstra/fontawesome.svg)](https://packagist.org/packages/blomstra/fontawesome)

A [Flarum](http://flarum.org) extension. Upgrade FontAwesome on your forum to version 6 (Free or Pro).

Please note that you must use a [Font Awesome Kit](https://fontawesome.com/kits) for 6 Pro functionality currently.

![](https://extiverse.com/extension/blomstra/fontawesome/open-graph-image)

## Installation

Install with composer:

```sh
composer require blomstra/fontawesome:"*"
php flarum assets:publish
```

## Updating

```sh
composer update blomstra/fontawesome:"*"
php flarum migrate
php flarum cache:clear
php flarum assets:publish
```

## Troubleshooting

If your icons aren't displaying, you may need to manually publish your forum's assets.

```
php flarum assets:publish
```

## Links

- [Packagist](https://packagist.org/packages/blomstra/fontawesome)
- [GitHub](https://github.com/blomstra/flarum-ext-fontawesome)
- [Discuss](https://discuss.flarum.org/d/31219-blomstra-font-awesome-6)
