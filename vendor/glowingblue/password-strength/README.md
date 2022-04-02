# Password Strength Indicator for Flarum

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/glowingblue/flarum-ext-password-strength/blob/master/LICENSE)
[![Latest Stable Version](https://img.shields.io/packagist/v/glowingblue/password-strength.svg)](https://packagist.org/packages/glowingblue/password-strength)
[![Total Downloads](https://img.shields.io/packagist/dt/glowingblue/password-strength.svg)](https://packagist.org/packages/glowingblue/password-strength)

Low-budget password strength estimation for your forum.

![Indicator](https://i.imgur.com/j4QErvP.gif)

[Click to view settings screenshot](https://i.ibb.co/r5ftZRb/ps-Settings.png)

## 🦸 Features

-   Based on [zxcvbn-ts](https://zxcvbn-ts.github.io/zxcvbn/).
-   Password strength is labeled as 'Weak', 'Could be stronger' and 'Strong'.
-   Customizable display modes.
-   Compatible with `nearata/flarum-ext-signup-confirm-password`.

## 📥 Installation

```bash
composer require glowingblue/password-strength
```

## ♻ Updating

```bash
composer update glowingblue/password-strength
php flarum cache:clear
```

## 🚫 Conflicts

-   `glowingblue/password-strength` doesn't work with `therealsujitk/flarum-ext-show-password` which
    can be removed, as `glowingblue/password-strength` adds a very similar functionality.

## 📖 Usage

Just enable the extension and customize if you wish.

## 📝 To-do

-   I have no idea about how to implement it inside the reset password blade but you're very welcome
    to guide me or open a pull request on
    [GitHub](https://github.com/glowingblue/flarum-ext-password-strength).

## 🔗 Links

-   [Flarum Discuss post](https://discuss.flarum.org/d/26191)
-   [Source code on GitHub](https://github.com/glowingblue/flarum-ext-password-strength)
-   [Changelog](https://github.com/glowingblue/flarum-ext-password-strength/blob/master/CHANGELOG.md)
-   [Report an issue](https://github.com/glowingblue/flarum-ext-password-strength/issues)
-   [Download via Packagist](https://packagist.org/packages/glowingblue/password-strength)
