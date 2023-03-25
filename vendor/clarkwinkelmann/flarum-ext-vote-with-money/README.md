# Vote with Money

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/clarkwinkelmann/flarum-ext-vote-with-money/blob/master/LICENSE.txt) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-vote-with-money.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-vote-with-money) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-vote-with-money.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-vote-with-money) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

This is a companion extension to the [Money extension](https://github.com/AntoineFr/flarum-ext-money) by AntoineFr and [Polls extension](https://github.com/FriendsOfFlarum/polls) by FriendsOfFlarum.

The extension adds a new kind of polls where users vote with money.
The amount pledged can be customized and results are sorted by the total money given to each option.

When creating a poll, a new switch is added to turn the poll into a money poll.
A local or global min/max value can be configured in the poll/extension settings.
A list of predefined amounts can be configured in the extension settings.
The user can always choose a custom value if they want.

Limitations:

- Users cannot edit or cancel their vote.
- The poll option image is not shown in the recap at the top of the vote modal.
- The money pledged must be an integer amount.
- The pre-selected amounts will always be shown even if they don't meet the local min/max setting, but will error if trying to submit.
- In the FoF Polls translations, the tooltips reference the number of votes, which are now the amount of money and no longer the number of users. You can edit the translations with FoF Linguist if you prefer to call them differently.
- The Pusher/Websocket integration of FoF Polls will not be triggered for money-based polls.
- Once a poll received votes, it can no longer be switched from normal to money or vice-versa.

## Installation

Requires version 1.3+ of FoF Polls.

    composer require clarkwinkelmann/flarum-ext-vote-with-money

## Support

This extension is under **minimal maintenance**.

It was developed for a client and released as open-source for the benefit of the community.
I might publish simple bugfixes or compatibility updates for free.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features or updates.

Support is offered on a "best effort" basis through the Flarum community thread.

**Sponsors**: annonny

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-vote-with-money)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-vote-with-money)
- [Discuss](https://discuss.flarum.org/d/32016)
