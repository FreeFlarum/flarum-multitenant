# Two Factor By ReFlar

[![GitLab license](https://img.shields.io/badge/license-MIT-blue.svg)](https://gitlab.com/ReDevelopers/ReFlar/twofactor/blob/master/LICENSE) [![Latest Stable Version](https://img.shields.io/packagist/v/reflar/twofactor.svg)](https://gitlab.com/ReDevelopers/ReFlar/twofactor/)


#### Importing from the old twofactor

- Simply install this, everything will be transfered to the new extension automatically

##### Please read the install guide!

A [Flarum](http://flarum.org) extension that increases security by adding TOTP and Twillio two factor authentication

### Usage

- As a user, go to your account settings page and follow the prompts to setup twofactor
- Admins have the option to link their Twillio account to allow users to recieve codes via text

### Installation

This extension requires a bit more setup. These steps are optional but will greatly increase the security of this plugin.

First install it with composer:

```bash
composer require reflar/twofactor
```

Then login and enable the extension.

#### !!Make sure to undo this if you ever uninstall this extension!!

If you have Apache, add these lines right after the "RewriteEngine on"

```
  RewriteCond %{REQUEST_URI} ^/login
  RewriteRule ^(.*)$ - [F,L]
```

If you have Nginx add these lines to your server block:

```
  location ~ ^/login {
                deny all;
  }
```

Q: What does this do?
A: This extension uses a custom login handler and therefore a different url to send the login request to. If someone changes the url back to the default they could bypass the twof factor auth.
### To Do

- Requests?

### Issues

- None known


### Links

- [on Github](https://github.com/ReFlar/twofactor)
- [Issues](https://github.com/ReFlar/twofactor/issues)
