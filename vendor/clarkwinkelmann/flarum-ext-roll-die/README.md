# Roll a Die

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/clarkwinkelmann/flarum-ext-roll-die/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-roll-die.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-roll-die) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-roll-die.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-roll-die) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

> This extension is experimental. Don't use it for anything too serious just yet. Please report any issue you find!

To roll a die, insert any of the die emoji (🎲 ⚀ ⚁ ⚂ ⚃ ⚄ ⚅) on its own line in the post.
The emoji can also be inside a block quote.

The random numbers are picked when the post is saved.
When the post is edited, the numbers don't change, and continue to be applied in the same order (first die emoji in the post will keep the same number, even if it was moved in the content, same for second, etc.).
This behavior can be modified in the admin panel.

The native emoji from the user system fonts are used, so the look can differ between devices.
If the emoji fails to render, the random number is still accessible through a tooltip.

There might be issues with die emojis inserted inside of markdown or bbcode if they are alone on their line but not actually at the first level of the content.
When this happens, the numbers could end up misaligned with the emojis during rendering.

The random numbers are not actually stored in the post body, but as a special post attribute.
They are then mapped to the emojis in the frontend based on their order in the body.

If the post is rendered outside the Flarum web discussion, the original emoji inserted by the post author will be visible: emails, push notifications, etc.
But it will not be stylised like the random dice in the discussion.

If the extension is disabled, the original emoji inserted by the post author will become visible again instead of the randomized die.

## Installation

    composer require clarkwinkelmann/flarum-ext-roll-die

## Support

This extension is under **minimal maintenance**.

It was developed for a client and released as open-source for the benefit of the community.
I might publish simple bugfixes or compatibility updates for free.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features or updates.

Support is offered on a "best effort" basis through the Flarum community thread.

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-roll-die)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-roll-die)
- [Discuss](https://discuss.flarum.org/d/29698)
