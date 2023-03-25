# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.2.1] - 2022-09-09

- Fix BBCode not working with alphanumerical ids.

## [3.2.0] - 2022-08-24

- Add missing translations.
- Now the player will load/update while editing a post.
- Ability to choose which groups can view the video players.
- `php flarum nearataEmbedVideo:purge` to remove ALL video players from posts.
- Extended modal with ability to add, update and remove video players and related qualities.
- Ability to disable the modal and insert the BBCode at cursor point.

## [3.1.1] - 2022-08-04

- Fix packagist license

## [3.1.0] - 2022-08-04

- Ability to limit the creation of video players based on tags and user rank.

## [3.0.0] - 2021-06-20

- (Updated) Flarum 1.0
- (Updated) MSE extensions

## [2.1.1] - 2021-04-16

- (Fix) The player was loaded before the extensions and as result the extensions were not working properly.

## [2.1.0] - 2021-03-17

- Updated to beta 16

## [2.0.0] - 2021-03-12

- (Added) Theme color to customize the primary color of the player
- (Added) The option to add a logo to the player
- (Added) Supported languages (en, zh-cn and zh-tw)
- (Added) Quality switching
- (Improved) The player and MSE extensions are now loaded dynamically and only if enabled
- (Improved) Each MSE extension can be enabled / disabled in the admin panel (all disabled by default)

## [1.2.0] - 2021-01-28

- Updated to Beta 15
- (Added) Permissions
- (Updated) Update JS dependencies

## [1.1.0] - 2020-10-26

- Updated to beta 14

## [1.0.0] - 2020-07-22

- First release
