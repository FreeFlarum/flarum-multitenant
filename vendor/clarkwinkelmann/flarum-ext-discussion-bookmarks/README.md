# Discussion Bookmarks

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-discussion-bookmarks.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-discussion-bookmarks) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-discussion-bookmarks.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-discussion-bookmarks) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

This extension lets user bookmark discussions.

Bookmarked discussions have a badge and appear under the additional bookmarks page.

Bookmarked discussions work similarly to Followed discussions, but don't have any notification system linked to them.

A single setting lets you customize whether you want the control to be accessible in the discussion side navigation like the subscription, or only in the discussion dropdown.

## Installation

    composer require clarkwinkelmann/flarum-ext-discussion-bookmarks

## Upgrade from v1

Version 1.x of the extension used the package name `clarkwinkelmann/flarum-ext-bookmarks`.

Simply run the `require` command from above to install the new extension.
The old extension will automatically be disabled.

The extension settings will not be preserved, so make sure to reconfigure them after upgrading (there's just one setting in the v1 version).

The default URL for bookmarks changed and no redirect is provided.

Your custom CSS might require adjusting to CSS class name changes.

## Support

This extension is under **minimal maintenance**.

It was developed for a client and released as open-source for the benefit of the community.
I might publish simple bugfixes or compatibility updates for free.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features or updates.

Support is offered on a "best effort" basis through the Flarum community thread.

**Sponsors**: [Phenomlab](https://phenomlab.net/), [ctml](https://discuss.flarum.org/u/ctml), [Glowing Blue](https://glowingblue.com/)

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-discussion-bookmarks)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-discussion-bookmarks)
- [Discuss](https://discuss.flarum.org/d/25357)
