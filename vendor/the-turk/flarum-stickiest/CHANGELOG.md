### 3.0.1

- **Fix** tag stickied discussions goes missing when you change their tags.

### 3.0.0

Requires Flarum v1.2.0+ & `flarum/tags` & `flarum/sticky`

- **Add** new modal component (replaces discussion control items).
- **Add** new option for displaying tag-stickied discussions in the "All Discussions" list.
- **Add** new label for super-tag-stickied discussions. (+ new `Stickiest-tagStickiestItem` class for discussion list items.)
- **Update** js dependencies and imports.

Also fixes some mistakes on order logic.

**!! Breaking change:** Your current tag-sticky configurations will be lost. They magically will stay as just-sticky.

Don't forget to run migrations if you're upgrading from `2.0.x`

```bash
composer require the-turk/flarum-stickiest:^3.0.0
php flarum migrate
php flarum cache:clear
```

If you ever see an error like `General error: 1824 Failed to open the referenced table 'tags' ...` while activating this version, check if the engine for the `tags` table is InnoDB or not. If not, try switching that to the InnoDB then run and try activating again:

```bash
php flarum migrate:reset --extension the-turk-stickiest
```
```sql
DROP TABLE `discussion_sticky_tag`;
```

### 2.0.3

- Separate permissions for tag sticky / stickiest discussions.

### 2.0.2

- Add `Stickiest-stickyItem`, `Stickiest-tagStickyItem`, `Stickiest-stickiestItem` classes for discussion list items.

### 2.0.1 (Stable)

- Re-built on top of `flarum/sticky` (requires it) so if you disable this extension, you won't lose your sticky discussions.
- **Fix** permission related errors.
- **Fix** wrong badge tooltip for tag-stickied discussions.

Upgrading from previous `beta` versions (thanks for the test drive, upgrading to stable will cause losing your sticky discussion configurations - I didn't want to perform extra operations to keep them as the extension was in beta phase):

```
php flarum migrate:reset --extension the-turk-stickiest
composer remove the-turk/flarum-stickiest
composer require flarum/sticky
composer require the-turk/flarum-stickiest:^2.0.1
php flarum cache:clear
```

### 2.0.0-beta.2

Possible fix for the nested `UNION` errors.

### 2.0.0-beta.1

Initial _stickiest_ release.