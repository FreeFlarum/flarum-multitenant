# fancyBox Extension for Flarum

[![GPLv3 license](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://github.com/malago/flarum-ext-fancybox/blob/master/LICENSE) [![Latest Stable Version](https://img.shields.io/packagist/v/malago/flarum-ext-fancybox.svg)](https://packagist.org/packages/malago/flarum-ext-fancybox) [![Total Downloads](https://img.shields.io/packagist/dt/malago/flarum-ext-fancybox.svg)](https://packagist.org/packages/malago/flarum-ext-fancybox)

**Disclaimer:** This extension has forked from `the-turk/flarum-ext-fancybox`

![fancyBox](https://i.ibb.co/kBWDJSL/fancyBox.png)

## Features

- Based on [fancyBox v3](https://github.com/fancyapps/fancybox).
- Clicking on an image in a post launches the fancyBox modal. This allows users to zoom in on the image, pan around, and navigate among multiple images, videos or iframes on the same post as a gallery.
- Images are displayed with formatting to normalize sizes and layout.
- If the author of the post has wrapped the image in a link, it will be shown as an external link. (Clicking on the image will not launch the fancyBox modal in this case.)
- Image or URL titles are considered as captions.

**Note:** This extension does not generate thumbnails. The storage location of images, and the file size / bandwidth usage are not affected.

## Conflictions

- This package conflicts with `squeevee/flarum-ext-fancybox` and `the-turk/flarum-ext-fancybox`, so you need to remove them first.
- It seems like this package is not compatible with `reflar/recache` (see [#4](https://github.com/squeevee/flarum-ext-fancybox/issues/4)).

## Installation

```bash
composer require malago/flarum-ext-fancybox
```

## Updating

```bash
composer update malago/flarum-ext-fancybox
php flarum cache:clear
```

## Usage

Enable the extension.

### Image layouts

Image layouts can be controlled by the formatting of the post's markup (e.g., its BBCode or Markdown).

An image is "stand-alone" if it is not in a paragraph with any text or other images, i.e., it is separated from text or other images by _at least two returns_. A stand-alone image is displayed in large format.

![Example of a stand-alone image](https://i.ibb.co/pj8hbYt/fancy-block.png)

An image is "inline" if it is in a paragraph with text or other images. An inline image is displayed in small format, in order to fit into the flow of text.

![Example of an inline image](https://i.ibb.co/kDB8ndT/fancy-inline.png)

(For technical reasons, an image is considered inline if it is separated from text or another image by only one return.)

If you have the `flarum/bbcode` extension, you can use `[img fancy=off][/img]` to prevent images from formatting by this extension. This will also exclude them from the fancyBox gallery of the post.

### Links

As mentioned under Features, if an image is wrapped in a link, its behavior and appearance are altered. Most notably, in order to preserve the link, clicking on the image opens the link instead of opening the fancyBox modal. Images within links are also not added to the fancyBox gallery for a post.

![External linked image](https://i.ibb.co/WG1xSNm/fancy-external.png)

That said, if you have the `flarum/bbcode` extension, you can use `fancy` attribute of the `URL` tag to show videos or iframes on the fancyBox modal. They will be added to the fancyBox gallery of the post.

- Use `[URL fancy=iframe][/URL]` for iframes:

    ![Iframe](https://i.ibb.co/svHhPrM/fancy-iframe.png)

- Use `[URL fancy=video][/URL]` for videos (fancyBox supports YouTube, Vimeo & MP4):

    ![Video](https://i.ibb.co/dGRrtwf/fancy-video.png)


### Captions

You need to have the `flarum/bbcode` extension in order to add captions. The `title` attribute of the `IMG` or the `URL` tag will be automatically considered as a caption (the `IMG` tag has the higher priority). Here are some possible usage examples:

![Caption](https://i.ibb.co/4NxbZst/fancy-caption.png)

```
[img title="Caption this."][/img]
[url title="Caption this." fancy]![](src)[/url]
[url title="Caption this." fancy=video][img][/img][/url]
[url fancy][img title="Caption this."][/img][/url]
```

## Links

- [Flarum Discuss post](https://discuss.flarum.org/d/19535-fancybox-extension-beta)
- [Source code on GitHub](https://github.com/malago86/flarum-ext-fancybox)
- [Changelog](https://github.com/malago86/flarum-ext-fancybox/blob/master/CHANGELOG.md)
- [Download via Packagist](https://packagist.org/packages/malago/flarum-ext-fancybox)
