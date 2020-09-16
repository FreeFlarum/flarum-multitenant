# Author Change

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-author-change.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-author-change) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-author-change.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-author-change) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

Let mods update the author and date of discussions and posts.

The author edit button is added underneath the title/tag edit button for discussions and under the content edit button for posts.

#### Author edit

Users with "Update author" permission must also have the "View user list" permission to be able to search for users.

#### Date edit

The field uses the native [datetime-local](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/datetime-local) picker in browsers that support it (at the time of writing, Chrome/Edge/Opera).
The field format in supported browser will match your browser/operating system language and country setting.

**The time in the modal is UTC.**

#### Other

The first post of a discussion and the discussion itself are not automatically synced.
You will probably want to edit the data in both places.

> This extension was written live on YouTube.
> Watch the video on the Clark writes code channel: [Author part](https://www.youtube.com/watch?v=v89ro_sO0nU), [Date part](https://www.youtube.com/watch?v=uc-itrO-nug).
> Support me on [Patreon](https://www.patreon.com/clark_writes_code)!

### Installation

```sh
composer require clarkwinkelmann/flarum-ext-author-change
```

### Updating

```sh
composer update clarkwinkelmann/flarum-ext-author-change
```

### Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-author-change)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-author-change)
- [Discuss](https://discuss.flarum.org/d/21731)
