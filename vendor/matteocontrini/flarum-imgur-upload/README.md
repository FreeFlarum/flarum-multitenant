# flarum-imgur-upload [![Packagist](https://img.shields.io/packagist/v/matteocontrini/flarum-imgur-upload.svg)](https://packagist.org/packages/matteocontrini/flarum-imgur-upload)

**flarum-imgur-upload** is a [Flarum](https://github.com/flarum/flarum/) extension that allows posting images in Flarum posts using [Imgur](https://imgur.com/) for image hosting.

## Features

With flarum-imgur-upload you can upload images to Imgur while writing your post, and the extension will automatically embed the images in your post. You can also paste from clipboard to upload an image file.

![Demo GIF](https://i.imgur.com/46VYGzz.gif)

## Installation

```
composer require matteocontrini/flarum-imgur-upload
```

If you previously used `matpompili/flarum-imgur-upload` (the original work on this extension by Matteo Pompili) or `botfactoryit/flarum-imgur-upload`, you should disable and remove those extensions when you upgrade to beta 8.

## Configuration

Since **flarum-imgur-upload** uses Imgur API to upload your images, you will need an Imgur Client ID.

To get one simply signup to [Imgur](https://imgur.com/), then register an application [here](https://api.imgur.com/oauth2/addclient).
You need to choose a name for your application (e.g. My Forum), and select *Anonymous usage without user authorization*. If the form requires you to set an *Authorization callback URL*, that's a bug. Select *OAuth 2 authorization without a callback URL* to avoid that, or play with the radio buttons a bit.

Once your application has been registered, your Client ID will be available [here](https://imgur.com/account/settings/apps). Copy and paste it in the configuration panel of the extension, through your forum's admin page.

## Credits

The original work for this extension was done by @matpompili.
