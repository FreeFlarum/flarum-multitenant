# Flamoji

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/the-turk/flarum-flamoji/blob/master/LICENSE) [![Latest Stable Version](https://img.shields.io/packagist/v/the-turk/flarum-flamoji.svg)](https://packagist.org/packages/the-turk/flarum-flamoji) [![Total Downloads](https://img.shields.io/packagist/dt/the-turk/flarum-flamoji.svg)](https://packagist.org/packages/the-turk/flarum-flamoji)

Simple emoji manager for Flarum.

Screenshots:

![Picker](https://i.imgur.com/I7l1s6O.png)

- [Settings](https://i.imgur.com/hqlbvZB.png)
- [Edit Emoji Modal](https://i.imgur.com/nonfIjB.png)

## Features

- Based on [joeattardi/emoji-button](https://github.com/joeattardi/emoji-button) repository.
- Add an emoji picker to the text editor (compatible with dark mode).
- Show Twemoji or unicode emojis in the picker.
- Search emojis in your own language.
- Add custom emojis to the picker.
- Import and export custom emoji configurations.
- Everything is dynamically loaded (no CDNs) when the picker is opened (there should be no performance impact until the user interacts with the picker).

## Installation

```bash
composer require the-turk/flarum-flamoji
```

## Updating

```bash
composer update the-turk/flarum-flamoji
php flarum migrate
php flarum assets:publish
php flarum cache:clear
```

### Import and Export Configurations

I added these features so we can share our custom emoji configurations. Just use the "Export JSON" button from the extension's settings page to export your configuration and "Import JSON" button to import others. However, importing action will only import the configuration, not the image files. You still need to upload those images manually into your server.

## Links

- [Source code on GitHub](https://github.com/the-turk/flarum-flamoji)
- [Changelog](https://github.com/the-turk/blob/master/CHANGELOG.md)
- [Report an issue](https://github.com/the-turk/flarum-flamoji/issues)
- [Download via Packagist](https://packagist.org/packages/the-turk/flarum-flamoji)
