# Create User Modal

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/clarkwinkelmann/flarum-ext-create-user-modal/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-create-user-modal.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-create-user-modal) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-create-user-modal.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-create-user-modal) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

This extension provides a modified Sign Up modal that creates a user and redirects to their profile.
Where the native Sign Up modal logs you into the new account by force, the Create User modal keeps your current session active and just creates the new user in the background.

The other benefit is that it's possible to access it when signup is closed right from the Flarum interface.
Technically admins could also open the Sign Up modal and use it, but it requires using the browser console.

If the User Directory extension is enabled, the link is added to the top of the user list.
Otherwise the link is added to the session dropdown.

This extension does not alter the Flarum core logic regarding the creation of users.
When signup is enabled, anybody can create accounts.
When signup is disabled, only admins can create accounts (this is hard-coded in Flarum).
The modal just uses the native API endpoint.

A permission allows you to customize who sees the "Create new user" button.

## Installation

    composer require clarkwinkelmann/flarum-ext-create-user-modal

## Tips

You can manually bring up the modal by calling

```js
app.modal.show(flarum.extensions['clarkwinkelmann-create-user-modal'].CreateUserModal)
```

You will only be able to submit it if you have the correct permissions though.

## Support

This extension is under **active maintenance**.

Bugfixes and compatibility updates will be published for free as time allows.

You can [contact me](https://clarkwinkelmann.com/flarum) to sponsor additional features.

Support is offered on a "best effort" basis through the Flarum community thread.

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-create-user-modal)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-create-user-modal)
- [Discuss](https://discuss.flarum.org/d/22608)
