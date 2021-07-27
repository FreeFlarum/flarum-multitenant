![1](https://user-images.githubusercontent.com/79002016/116794630-bf09af80-aace-11eb-8156-dd3e30ab6da0.png)
# Infocards

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/justoverclock/flarum-ext-infocards.svg)](https://packagist.org/packages/justoverclock/flarum-ext-infocards) [![Total Downloads](https://img.shields.io/packagist/dt/justoverclock/flarum-ext-infocards.svg)](https://packagist.org/packages/justoverclock/flarum-ext-infocards)

A [Flarum](http://flarum.org) extension. Display 3 infocards with basic forum stats.

 - Avatar Editor to uload/remove your avatar
 - Basic visitors counter
 - Total Post written
 - Total discussions opened
 - User Groups

### Usage

Visitor counter works through a free api, u need to create yours for free at:
https://countapi.xyz/

Or simply copy and paste this link (make sure to change your-namespace with your unique namespace
```
https://api.countapi.xyz/hit/YOUR-NAMESPACE/visits
```

### Installation

Install with composer:

```sh
composer require justoverclock/flarum-ext-infocards
```

### Updating

```sh
composer update justoverclock/flarum-ext-infocards
php flarum cache:clear
```

### Links

- [Packagist](https://packagist.org/packages/justoverclock/flarum-ext-infocards)
- [GitHub](https://github.com/justoverclockl/flarum-ext-infocards)
