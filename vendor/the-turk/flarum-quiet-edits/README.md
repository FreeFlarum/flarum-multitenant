# Quiet Edits for Flarum

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/the-turk/flarum-quiet-edits/blob/master/LICENSE) [![Latest Stable Version](https://img.shields.io/packagist/v/the-turk/flarum-quiet-edits.svg)](https://packagist.org/packages/the-turk/flarum-quiet-edits) [![Total Downloads](https://img.shields.io/packagist/dt/the-turk/flarum-quiet-edits.svg)](https://packagist.org/packages/the-turk/flarum-quiet-edits)

As I promised in @Kylo#121339, this is a preparation for next version of my [Diff extension](https://discuss.flarum.org/d/22779-diff-for-flarum). I'm not sure if I picked the right title for this extension 🤔. Anyways, edits made within the grace period immediately after posting will not be considered as formal edits. You can also ignore whitespace and case differences independently from the grace period.

- And again, it's based on @jfcherng's [diff](https://github.com/jfcherng/php-diff) repository.
- It raises new events for developers, called `PostWasRevisedQuietly` & `PostWasRevisedLoudly`

![Settings](https://i.imgur.com/MZNqmCR.png)

## Requirements

![php](https://img.shields.io/badge/php-%5E7.1.3-blue?style=flat-square) ![ext-iconv](https://img.shields.io/badge/ext-iconv-brightgreen?style=flat-square)

You can check your php version by running `php -v` and check if `iconv` is installed by running `php --ri iconv` (which should display `iconv support => enabled`).

## Installation

```bash
composer require the-turk/flarum-quiet-edits
```

## Updating

```bash
composer update the-turk/flarum-quiet-edits
php flarum cache:clear
```

## Usage

Enable the extension. The grace period is 120 seconds, whitespace and case differences will be ignored by default.

## Links

- [Flarum Discuss post](https://discuss.flarum.org/d/22916-quiet-edits)
- [Source code on GitHub](https://github.com/the-turk/flarum-quiet-edits)
- [Changelog](https://github.com/the-turk/flarum-quiet-edits/blob/master/CHANGELOG.md)
- [Report an issue](https://github.com/the-turk/flarum-quiet-edits/issues)
- [Download via Packagist](https://packagist.org/packages/the-turk/flarum-quiet-edits)
