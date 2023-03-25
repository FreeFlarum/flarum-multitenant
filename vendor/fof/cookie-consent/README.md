# Cookie Consent by FriendsOfFlarum

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/friendsofflarum/cookie-consent/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/fof/cookie-consent.svg)](https://packagist.org/packages/fof/cookie-consent) [![Total Downloads](https://img.shields.io/packagist/dt/fof/cookie-consent.svg)](https://packagist.org/packages/fof/cookie-consent) [![OpenCollective](https://img.shields.io/badge/opencollective-fof-blue.svg)](https://opencollective.com/fof/donate)

This extension adds a customizable Cookie Consent pop-up to your Flarum installation. 
Are you from a country where Cookie Consent laws are in place? Have no fear! We've got you covered!

## Installation

```bash
composer require fof/cookie-consent
```

## Updating

```bash
composer update fof/cookie-consent
php flarum cache:clear
```

## Configuration

Once enabled, a new modal to configure/customize your desired settings will appear.

## Usage

To get to the settings modal, click the triple dots that appear when hovering your mouse
cursor over the "Cookie Consent" extension text as shown below:

![Cookie Consent Extension Settings](https://i.imgur.com/xMAAEkT.png)

Once the settings modal pop-ups, configure/customize the settings like so:

![Cookie Consent Extension Configuration](https://i.imgur.com/JFZ3T3J.png)

Once completed, click "Save Changes" and make your way to your forum index.

You should now be presented with a one-time cookie consent notification!

![Cookie Consent Notification](https://i.imgur.com/RMvwX1V.png)

Pretty simple right? Now begone heathen!

## Testing

In order to get the Cookie Consent bar to pop-up again, you will have to delete the cookie
data related to your site which is named "cookieconsent_status" or, you can delete ALL of the 
cookie data related your site (NOT THE ENTIRE BROWSER!!) (See your respected browser manuals 
for more information about managing cookies). Once removed, refresh your forum index page
and it shall appear once more. Repeat the process anytime you wish to change any of the setting 
and want to see those settings live as you edit them.

Or you can just enter your forum in Incognito Mode (if supported).

## Links

- [Source code on GitHub](https://github.com/friendsofflarum/cookie-consent)
- [Report an issue](https://github.com/friendsofflarum/cookie-consent/issues)
- [Download via Packagist](https://packagist.org/packages/fof/cookie-consent)
