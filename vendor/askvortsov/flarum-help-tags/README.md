# Flarum Help Tags

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/askvortsov/flarum-help-tags.svg)](https://packagist.org/packages/askvortsov/flarum-help-tags)

A [Flarum](http://flarum.org) extension. Now, your users can create discussions in certain tags, but only certain groups can see/reply to posts in those tags. For instance, if you want to have a tag for private support, users could create posts there and manage their own posts, but could not see posts that other users have made. However, designated groups could see and reply to all posts in the tag.

### Installation

Use [Bazaar](https://discuss.flarum.org/d/5151-flagrow-bazaar-the-extension-marketplace) or install manually with composer:

```sh
composer require askvortsov/flarum-help-tags
```

### Updating

```sh
composer update askvortsov/flarum-help-tags
```

### Usage

Give the "start discussions" and "start discussions without approval" permissions in a tag to groups of users who should be able to start discussions, but not see ALL discussions in a tag.

Give the "view discussions" permission in a tag to groups of users who should be able to see ALL discussions in a tag.

You can use the "view tag" permission to show a tag to (possibly) all users. This will not affect how discussions in the tag are shown.

Admins can designate certain discussions as "visible to all" (there's a button in the discussion controls). This will show the discussion to all users who can post in the discussions tags. You might want to use this together with the sticky extension.

### Links

- [Packagist](https://packagist.org/packages/askvortsov/flarum-help-tags)
