# flarum-imgur-upload v3 [![Packagist](https://img.shields.io/packagist/v/matteocontrini/flarum-imgur-upload.svg)](https://packagist.org/packages/matteocontrini/flarum-imgur-upload)

**flarum-imgur-upload** is a [Flarum](https://github.com/flarum/flarum/) extension that allows posting images in Flarum posts using [Imgur](https://imgur.com/) for image hosting.

## Features
With flarum-imgur-upload you can upload images to Imgur while writing your post, and the extension will automatically embed the images in your post. You can also paste from clipboard to upload an image file.

Compared to the original extension (matpompili/flarum-imgur-upload), this extension:

- doesn't resize/change orientation of images. The raw file is uploaded to Imgur
- supports paste from clipboard
- has been rewritten to use Flarum components
- supports beta 8
- has a more polished UI

![Demo GIF](https://i.imgur.com/46VYGzz.gif)

## Installation

```
composer require matteocontrini/flarum-imgur-upload
```

If you previously used `matpompili/flarum-imgur-upload` (the original work on this extension by Matteo Pompili) or `botfactoryit/flarum-imgur-upload`, you should disable and remove those extensions when you upgrade to beta 8.

## Configuration

Since **flarum-imgur-upload** uses Imgur API to upload your images, you will need an Imgur Client ID. To get one simply register to the [Imgur](https://imgur.com/) website, and register an application [here](https://api.imgur.com/oauth2/addclient).
You need to choose a name for your application (e.g. My Forum), and select *Anonymous usage without user authorization*. If the form requires you to set an *Authorization callback URL*, that's a bug. Select *OAuth 2 authorization without a callback URL* to avoid that, or play with the radio buttons a bit.

Once your application has been registered, your Client ID will be available [here](https://imgur.com/account/settings/apps). Put it in the configuration of the extension, in your admin page.

## Credits

The original work for this extension was done by @matpompili.