### 0.3.0
- Added compatibility with Flarum 1.0.0

### 0.2.0-beta.5
- Added compatibility with Flarum 0.1.0-beta.14

### 0.2.0-beta.4
- **Fix** captions were not working when you define them in URL BBCodes.
- Give the `button` role to empty anchor tags for the sake of semantics.

### 0.2.0-beta.3
- **Fix** it was not working for elements inside tables.

### 0.2.0-beta.2
- **Add** close button.
- **Add** new `fancy` attribute for `IMG` and `URL` BBCodes (requires `flarum/bbcode` extension).
    + Use `[img fancy=off][/img]` for images those you don't want them to get _fancy_.
    + Use `[url fancy=iframe][/url]` for iframes.
    + Use `[url fancy=video][/url]` for videos (fancyBox supports YouTube, Vimeo & MP4).
- **Add** captions (requires `flarum/bbcode` extension).
    + Use `[img title="Caption this."][/img]` for images.
    + Alternatively, use `[url title="Caption this." fancy=video]![](src)[/url]` for others.
- **Fix** [#5](https://github.com/squeevee/flarum-ext-fancybox/issues/5).
- **Update** card layout, make it more _playable_.
- **Update** all dependencies.
- **Update** README.md

**Notes:**
- This package conflicts with `squeevee/flarum-ext-fancybox`, so you need to remove it first.
- It seems like this package is not compatible with `reflar/recache` (see [#4](https://github.com/squeevee/flarum-ext-fancybox/issues/4)).
