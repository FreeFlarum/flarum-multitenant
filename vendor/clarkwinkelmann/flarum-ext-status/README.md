# Status

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-status.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-status) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-status.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-status) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

Minimalistic user status for Flarum.

> This extension was written live on YouTube. Watch the video on the [Clark writes code channel](https://www.youtube.com/watch?v=iRVyF6BuotY). Support me on [Patreon](https://www.patreon.com/clark_writes_code)!

## Installation

    composer require clarkwinkelmann/flarum-ext-status

## Emoji list

The emoji lists for PHP were generated from the `simple-emoji-map` node package via those javascript commands:

```
console.log(JSON.stringify(Object.keys(emojiMap))); // all.json
console.log(JSON.stringify(Object.keys(emojiMap).filter(emoji => emojiMap[emoji][0].indexOf('flag_') === 0))); // flags.json
```

## Support

This extension is under **minimal maintenance**.

It was developed for a client and released as open-source for the benefit of the community.
I might publish simple bugfixes or compatibility updates for free.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features or updates.

Support is offered on a "best effort" basis through the Flarum community thread.

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-status)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-status)
- [Discuss](https://discuss.flarum.org/d/21983)
