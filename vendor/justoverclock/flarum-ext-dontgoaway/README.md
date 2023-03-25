![ezgif-7-9054ec048664](https://user-images.githubusercontent.com/79002016/117632492-78c2e900-b17d-11eb-884d-be9106485e5f.gif)
![Immagine-2021-05-10-174221](https://user-images.githubusercontent.com/79002016/117704899-ad5d9180-b1cb-11eb-974f-81d72d80e815.png)

# Dontgoaway - Exit intent popup + External Link Alert System

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://poser.pugx.org/justoverclock/flarum-ext-dontgoaway/v)](//packagist.org/packages/justoverclock/flarum-ext-dontgoaway) [![Total Downloads](https://poser.pugx.org/justoverclock/flarum-ext-dontgoaway/downloads)](//packagist.org/packages/justoverclock/flarum-ext-dontgoaway)

A [Flarum](http://flarum.org) extension. Show a Popup if a guest try to leave your site, and show modal for all external link.

Function available:
 - When user click on external link, a popup will ask for consent before leaving the website
 - The Exit Int popup will be showed only for guest
 - The modal uses sessionstorage to appear only once per session
 
 Modal Customization through admin setting:
 - Enable/Disable External link popup
 - Modal Title
 - Modal Text
 - Modal Image
 - Image width
 - Image Height
 - Button fontawesome icon
 - Button Text

### Installation

Install with composer:

```sh
composer require justoverclock/flarum-ext-dontgoaway
```

### Updating

```sh
composer update justoverclock/flarum-ext-dontgoaway
php flarum cache:clear
```

### Links

- [Packagist](https://packagist.org/packages/justoverclock/flarum-ext-dontgoaway)
- [GitHub](https://github.com/justoverclockl/flarum-ext-dontgoaway)

