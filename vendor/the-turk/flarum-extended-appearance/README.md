# Extended Appearance Settings

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/the-turk/flarum-extended-appearance/blob/master/LICENSE) [![Latest Stable Version](https://img.shields.io/packagist/v/the-turk/flarum-extended-appearance.svg)](https://packagist.org/packages/the-turk/flarum-extended-appearance) [![Total Downloads](https://img.shields.io/packagist/dt/the-turk/flarum-extended-appearance.svg)](https://packagist.org/packages/the-turk/flarum-extended-appearance)

It can be so hard sometimes to choose best colors that go together while customizing Flarum and it's nightmare if you're using admin panel-only for adding some custom LESS/CSS/HTML - especially if you're a newcomer or less technical. I hope this extension speeds up your customization process and gives you some inspiration for your next Flarum theme as it does for me.

![Colors](https://i.imgur.com/Ix7Z6XB.gif)

![CodeMirror](https://i.ibb.co/BTr4tzn/code-Mirror.png)

## Features

- Live theme visualization with [Pickr](https://github.com/Simonwep/pickr) implementation
- In-browser code editor powered by [CodeMirror](https://github.com/codemirror/codemirror)
- Relocate sidebar to the right or keep it on the left
- Prevent admin page from reloading after saving LESS/CSS/HTML changes
- Integration with `clarkwinkelmann/flarum-ext-scratchpad` extension

## Conflictions

This extension conflicts with [the-turk/flarum-stargazing-theme](https://discuss.flarum.org/d/22694-stargazing-theme) package for now. I plan to release a new version for it in order to solve this confliction.

## Installation

```bash
composer require the-turk/flarum-extended-appearance
```

## Updating

```bash
composer update the-turk/flarum-extended-appearance
php flarum cache:clear
```

## Usage

Just enable the extension and go to the "Appearance" settings.

## Links

- [Flarum Discuss post](https://discuss.flarum.org/d/23827-extended-appearance-settings)
- [Source code on GitHub](https://github.com/the-turk/flarum-extended-appearance)
- [Changelog](https://github.com/the-turk/flarum-extended-appearance/blob/master/CHANGELOG.md)
- [Report an issue](https://github.com/the-turk/flarum-extended-appearance/issues)
- [Download via Packagist](https://packagist.org/packages/the-turk/flarum-extended-appearance)
