# Stickiest

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/the-turk/flarum-stickiest/blob/master/LICENSE) [![Latest Stable Version](https://img.shields.io/packagist/v/the-turk/flarum-stickiest?include_prereleases)](https://packagist.org/packages/the-turk/flarum-stickiest) [![Total Downloads](https://img.shields.io/packagist/dt/the-turk/flarum-stickiest.svg)](https://packagist.org/packages/the-turk/flarum-stickiest)

Stick, super stick or tag stick discussions to the top of the list.

Screenshots:

![Stickiest Modal](https://i.imgur.com/Do7u5TF.png)

- [Super Sticky Discussion in All Discussions List](https://i.imgur.com/ANKsbBG.png)
- [Super Sticky & Tag Sticky Discussion in Tag's Discussion List](https://i.imgur.com/7q52yb4.png)

## Installation

```bash
composer require the-turk/flarum-stickiest:^3.0.0
```

If you ever see an error like `General error: 1824 Failed to open the referenced table 'tags' ...` while activating `3.0.x`, check if the engine for the `tags` table is InnoDB or not. If not, try switching that to the InnoDB then run and try activating again:

```bash
php flarum migrate:reset --extension the-turk-stickiest
```
```sql
DROP TABLE `discussion_sticky_tag`;
```

## Updating

```
composer update the-turk/flarum-stickiest
php flarum cache:clear
```

## Usage

You may find this complicated in first use but I bet you'll get used to it.

Enable the extension and set the permissions, choose a badge for super stickied discussions if you like. Click on the "Sticky" button like you're using the `flarum/sticky` extension and read the descriptions within the modal.

## Links

- [Source code on GitHub](https://github.com/the-turk/flarum-stickiest)
- [Changelog](https://github.com/the-turk/blob/master/CHANGELOG.md)
- [Report an issue](https://github.com/the-turk/flarum-stickiest/issues)
- [Download via Packagist](https://packagist.org/packages/the-turk/flarum-stickiest)
