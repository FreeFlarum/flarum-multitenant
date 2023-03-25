# Embed Video

> A [Flarum](https://flarum.org) extension that allow users to embed video using BBCode.

## Install

```sh
composer require nearata/flarum-ext-embed-video
```

## Remove

```sh
composer remove nearata/flarum-ext-embed-video
php flarum cache:clear
```

## How to use

```js
[embed-video id="insertRandomId" url="" type="normal" live="false" qualities=""]
```

- id: can be any string, prefer random.
- url: must start with http or https.
- type: normal, flv, hls, shaka, webtorrent.
- live: true or false.
- qualities: check below.

## Quality Switching

See [QUALITY_SWITCHING.md](QUALITY_SWITCHING.md).
