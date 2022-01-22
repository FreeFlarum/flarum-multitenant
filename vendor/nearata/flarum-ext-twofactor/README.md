# Two Factor

![supports](https://flarum-badge-api.davwheat.dev/v1/compat-latest/nearata/flarum-ext-twofactor)

> A [Flarum](http://flarum.org) extension. Allow your users to enable two factor authentication.

[Imgur](https://imgur.com/a/FMnO5rn)

## Note

- To allow the generation of backup codes, you must enable it in the admin settings of the extension.
- Users can't use API if they have two factor enabled.

## Install

```sh
composer require nearata/flarum-ext-twofactor
```

## Update

```sh
composer update nearata/flarum-ext-twofactor
php flarum cache:clear
php flarum migrate
```

## Remove

Disable the extension, click uninstall and run these commands:

```sh
composer remove nearata/flarum-ext-twofactor
php flarum cache:clear
```

## License

Distributed under the MIT license. See [LICENSE](LICENSE) for details.
