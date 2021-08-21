# MiniFLAR BBCode Progress Bars

![License](https://img.shields.io/badge/license-MIT-blue.svg?style=for-the-badge) [![Latest Stable Version](https://img.shields.io/packagist/v/miniflar/bbcode-progress-bars.svg?style=for-the-badge)](https://packagist.org/packages/miniflar/bbcode-progress-bars) [![PayPal](https://img.shields.io/badge/paypal-ralkage-4cl?style=for-the-badge&logo=paypal)](https://paypal.me/ralkage)

A [Flarum](http://flarum.org) extension. Embed progress bars inside Flarum posts using BBCode.

A revival of [0E800's BBCode Progress Bar Extension](https://github.com/0E800/flarum-ext-bbcode-bars).

## Installation

This will also install [flarum/bbcode](https://github.com/flarum/bbcode) as it relies on it.

Install with composer:

```sh
composer require miniflar/bbcode-progress-bars:"*"
```

## Usage

`[PBAR]Title,ProgressText,BorderColor,ProgressColor,LittleColor,BorderSize,Progress%,BorderRadius,BottomMargin[/PBAR]`


## Examples

`[PBAR]Total,70% Complete,black,red,pink,1,70,5,40[/PBAR]`

`[PBAR]Front-end,30% Complete,black,blue,teal,1,30,10,80[/PBAR]`

`[PBAR]Back-end,40% Complete,black,black,gray,1,40,20,0[/PBAR]`

## Screenshots
<details>
<summary>Forum Example</summary>

![BBCode Progress Bars](http://i.imgur.com/a3Tr3qx.png)
</details>

## Links

- [Packagist](https://packagist.org/packages/miniflar/bbcode-progress-bars)
- [GitHub](https://github.com/miniflar/bbcode-progress-bars)
- [Discuss](https://discuss.flarum.org/d/28694)
- [0E800's BBCode Progress Bar Extension](https://github.com/0E800/flarum-ext-bbcode-bars)

An extension by [miniFLAR](https://github.com/miniflar).
