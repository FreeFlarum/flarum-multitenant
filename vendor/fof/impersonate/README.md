# Impersonate by FriendsOfFlarum

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/FriendsOfFlarum/impersonate/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/fof/impersonate.svg)](https://packagist.org/packages/fof/impersonate) [![Total Downloads](https://img.shields.io/packagist/dt/fof/impersonate.svg)](https://packagist.org/packages/fof/impersonate) [![OpenCollective](https://img.shields.io/badge/opencollective-fof-blue.svg)](https://opencollective.com/fof/donate)

This extension adds a "Log in as user" button on user profiles for administrators and others who are granted the permission.

## Installation

Use [Bazaar](https://discuss.flarum.org/d/5151) or install manually:

```bash
composer require fof/impersonate
```

## Updating

```bash
composer update fof/impersonate
php flarum migrate
php flarum cache:clear
```

## Configuration

You can configure which groups can impersonate users by going to *Permissions > Login as other users*.
Use with caution, as anybody with that permission can easily access the private data of every user on the forum.
**non-admins cannot impersonate an admin account, for security reasons.**

## Links

- [![OpenCollective](https://img.shields.io/badge/donate-friendsofflarum-44AEE5?style=for-the-badge&logo=open-collective)](https://opencollective.com/fof/donate)
- [Flarum Discuss post](https://discuss.flarum.org/d/9868)
- [Source code on GitHub](https://github.com/FriendsOfFlarum/impersonate)
- [Report an issue](https://github.com/FriendsOfFlarum/issues)
- [Download via Packagist](https://packagist.org/packages/fof/impersonate)
