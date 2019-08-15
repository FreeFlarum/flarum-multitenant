# Canonical Url extension by MigrateToFlarum

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/migratetoflarum/canonical/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/migratetoflarum/canonical.svg)](https://packagist.org/packages/migratetoflarum/canonical) [![Total Downloads](https://img.shields.io/packagist/dt/migratetoflarum/canonical.svg)](https://packagist.org/packages/migratetoflarum/canonical) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

This extensions creates redirects so that Flarum can only be accessed via the url defined in `config.php`.

> **First note:** your host might already be doing those redirects for you.
> If that's the case, then you don't need this extension.

> **Second note:** if your host supports configuring redirects (via Apache Rewrites or Nginx server rules for example), I recommend using that instead of an extension for better performance.
> If those features are not available or if you don't have the technical knowledge to use them, then this extension is for you!

## Installation

Use [Bazaar](https://discuss.flarum.org/d/5151-flagrow-bazaar-the-extension-marketplace) or install manually:

```bash
composer require migratetoflarum/canonical
```

## Updating

```bash
composer update migratetoflarum/canonical
php flarum cache:clear
```

## Documentation

To enable the redirects, first enable the extension in your Flarum dashboard.
Then access the extension settings and select a redirect status.

The extension settings will only be available when you access the forum wia the canonical url.
This should prevent you from getting locked outside of the forum if Flarum cannot actually be reached via the url defined in `config.php`.

Before continuing, you should make sure the `url` value in `config.php` is the URL you want as canonical.
In particular if HTTPS is enabled on your host (as it should), make sure the canonical url includes `https://`.

You should first enable the temporary redirect option, so you can test the redirects without them being cached in every browser and search engine browsing the forum.
If your forum uses a bare domain (no `www.` subdomain), try accessing the `www.` subdomain and you should be redirected with a 302 status.
If your forum uses a `www.` subdomains, try accessing the bare domain (without `www.`).

Likewise, if your forum uses an HTTPS canonical url (again, as it should), trying to access it via `http://` should result in a 302 redirect to `https://`.

Once you confirmed everything is okay, you can switch the redirect status to permanent.
The redirect status code will be switched from 302 to 301.
Browsers and search engines will cache those redirects and stop to consider those pages as duplicates.

After all of this is done you can also submit your forum for a scan on the [MigrateToFlarum Lab](https://lab.migratetoflarum.com/) as an additional check 😉.

## Rescue mission

If you somehow get locked out of your forum because of a faulty redirect, here's what you can do:

- If you changed your forum hostname, update the `url` value in `config.php` and the extension will now redirect to that new url
- If you need to disable the redirects but don't have access to the dashboard anymore, you can manually edit the `migratetoflarum-canonical.status` entry in the `settings` table of your forum database. Set the value to `0` to disable the redirects

In any case, if a permanent redirect was cached and prevents you from accessing the address you need, you might have to clear:

- Your browser cache
- Cloudflare cache or the cache of other proxies your website is using
- If a search engine cached an incorrect redirect, you'll have to wait for it to expire or try to manually submit the page to the search engine for a new try

## A MigrateToFlarum extension

This is a free extension by MigrateToFlarum, an online forum migration tool (launching soon).
Follow us on Twitter for updates https://twitter.com/MigrateToFlarum

Need a custom Flarum extension ? [Contact Clark Winkelmann !](https://clarkwinkelmann.com/flarum)

## Links

- [Flarum Discuss post](https://discuss.flarum.org/d/19307)
- [Source code on GitHub](https://github.com/migratetoflarum/canonical)
- [Report an issue](https://github.com/migratetoflarum/canonical/issues)
- [Download via Packagist](https://packagist.org/packages/migratetoflarum/canonical)
