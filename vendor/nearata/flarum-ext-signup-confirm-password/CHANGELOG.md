# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

[Changes](https://github.com/Nearata/flarum-ext-signup-confirm-password/compare/v3.0.0...main)

## [3.0.0] - 2021-06-27

- Updated to Flarum 1.0

## [2.2.0] - 2021-03-23

[Changes](https://github.com/Nearata/flarum-ext-signup-confirm-password/compare/v2.1.0...v2.2.0)

- Updated to beta 16

## [2.1.0] - 2020-10-24

[Changes](https://github.com/Nearata/flarum-ext-signup-confirm-password/compare/v2.0.2...v2.1.0)

- Updated to Beta 14

## [2.0.2] - 2020-10-09

### Fix

- Fixed an issue where the extension was trying validating the password in the `Reset Password Page` when you request a new password reset. (Ref [Discuss#10](https://discuss.flarum.org/d/24689-sign-up-confirm-password/10))

## [2.0.1] - 2020-08-18

### Fix

- Fix error while assigning roles to users

## [2.0.0] - 2020-08-17

### Update

- `CheckingConfirmPassword`
  - Now the validations appears along with Flarum's one
- `Translations`
  - Renamed `confirm_password_placeholder` to `field_placeholder`
  - Renamed `passwords_not_match` to `password_must_match`
  - Updated `field_required`, `password_min_length` and `password_must_match` translations
- Updated field `name` html attribute from `confirmpassword` to `confirmPassword`

## [1.0.1] - 2020-08-16

### Fix

- Translations
  - `field_required` typo.

## [1.0.0] - 2020-08-15

- First release
