# Move Posts

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/sycho/flarum-move-posts.svg)](https://packagist.org/packages/sycho/flarum-move-posts) [![Total Downloads](https://img.shields.io/packagist/dt/sycho/flarum-move-posts.svg)](https://packagist.org/packages/sycho/flarum-move-posts)

A [Flarum](http://flarum.org) extension. Move posts from one discussion to another.

> **WARNING**: *This extension can in certain scenarios result in breaking old URLs to posts of the discussion you're moving posts to.*

## Usage

### Simple Move VS Complex Move
The extension allows you to select multiple posts to move from one discussion to another. Certain scenarios are not allowed, while others are allowed but yield to different results.

Moving posts can either be a simple process of pushing the posts at the end of the target discussion, or it can be a complicated process of pushing the posts in between the target discussion's posts, thus breaking the target discussion posts's old URLs (meaning old URLs will no longer point to the correct posts, because we update their number field to allow squeezing in the moved posts).
Which method will be chosen depends on the creation date of the posts being moved, and the creation date of the target discussion's last post.

The extension makes knowing which method will be used easily, by providing a `Check Operation Type` button in the relevant modal, so that you know what you're dealing with before proceeding.

The following diagram summarizes the couple scenarios:
![move-posts](https://user-images.githubusercontent.com/20267363/130121880-9a7303da-bfea-43fa-99d9-46af7bec6669.png)

### Moving The First Post
When moving the first post of a discussion:
* If the discussion only has that one post, that post will be replace by a normal post with the content `The discussion has been moved to Target Discussion` (the content is customizable through the admin panel).
* If the discussion has multiple posts, the first post will be replaced by an event posts (as per usual) and the second post will be set as first.

![move-posts-first](https://user-images.githubusercontent.com/20267363/130121900-8b6f1239-cfe3-4745-949a-b72ac8dbcafb.png)

### Event Posts
Moved posts are replaced by event posts.

## Installation

Install with composer:

```sh
composer require sycho/flarum-move-posts:"*"
```

## Updating

```sh
composer update sycho/flarum-move-posts:"*" --with-dependencies
php flarum migrate
php flarum cache:clear
```

## Support
This extension is under minimal maintenance.

It was developed for a client and released as open-source for the benefit of the community.
I might publish simple bugfixes or compatibility updates for free.

## Links

- [Packagist](https://packagist.org/packages/sycho/flarum-move-posts)
- [GitHub](https://github.com/sycho/flarum-move-posts)
- [Discuss](https://discuss.flarum.org/d/28824-move-posts)
