# Gói ngôn ngữ Tiếng việt dành cho [Flarum](http://flarum.org/)

Gói ngôn ngữ Tiếng việt dành cho Flarum.

## Thông tin

Gói ngôn ngữ được tương thích với những thành phần mở rộng sau:

- [Flarum](https://github.com/flarum/core)'s Core [0.1.0 Beta 15](https://github.com/flarum/core/releases/tag/v0.1.0-beta.15)
  - Phần mở rộng:
    - [Akismet](https://github.com/flarum/akismet) [0.1.0 Beta 9](https://github.com/flarum/akismet/releases/tag/v0.1.0-beta.9)
    - [Approval](https://github.com/flarum/approval) [0.1.0 Beta 8](https://github.com/flarum/approval/releases/tag/v0.1.0-beta.8)
    - [Facebook Login](https://github.com/flarum/auth-facebook) [0.1.0 Beta 9](https://github.com/flarum/auth-facebook/releases/tag/v0.1.0-beta.9)
    - [Flags](https://github.com/flarum/flags) [0.1.0 Beta 9](https://github.com/flarum/flags/releases/tag/v0.1.0-beta.9)
    - [GitHub Login](https://github.com/flarum/auth-github) [0.1.0 Beta 9](https://github.com/flarum/auth-github/releases/tag/v0.1.0-beta.9)
    - [Likes](https://github.com/flarum/likes) [0.1.0 Beta 9](https://github.com/flarum/likes/releases/tag/v0.1.0-beta.9)
    - [Lock](https://github.com/flarum/lock) [0.1.0 Beta 9](https://github.com/flarum/lock/releases/tag/v0.1.0-beta.9)
    - [Mentions](https://github.com/flarum/mentions) [0.1.0 Beta 9](https://github.com/flarum/mentions/releases/tag/v0.1.0-beta.9)
    - [Pusher](https://github.com/flarum/pusher) [0.1.0 Beta 9](https://github.com/flarum/pusher/releases/tag/v0.1.0-beta.9)
    - [Sticky](https://github.com/flarum/sticky) [0.1.0 Beta 9](https://github.com/flarum/sticky/releases/tag/v0.1.0-beta.9)
    - [Subscriptions](https://github.com/flarum/subscriptions) [0.1.0 Beta 9](https://github.com/flarum/subscriptions/releases/tag/v0.1.0-beta.9)
    - [Suspend](https://github.com/flarum/suspend) [0.1.0 Beta 9](https://github.com/flarum/suspend/releases/tag/v0.1.0-beta.9)
    - [Tags](https://github.com/flarum/tags) [0.1.0 Beta 15](https://github.com/flarum/tags/releases/tag/v0.1.0-beta.15)
    - [Twitter Login](https://github.com/flarum/auth-twitter) [0.1.0 Beta 9](https://github.com/flarum/auth-twitter/releases/tag/v0.1.0-beta.9)
  - Các thư viện:
    - [Laravel's Validation](https://github.com/laravel/laravel) [5.8.16](https://github.com/laravel/laravel/releases/tag/v5.8.16)
    - [Moment.js](https://github.com/moment/moment) [2.24.0](https://github.com/moment/moment/releases/tag/2.24.0)

Released under the MIT license. Xem thêm mục [license terms](https://github.com/luatdolphin/lang-vietnamese/blob/master/LICENSE).

## Hướng dẫn cài đặt

### Dùng trình quản lý gói Composer

Dùng trình quản lý gói trong dự án của bạn và chạy dòng lệnh sau:

```
composer require luatdolphin/lang-vietnamese
```

### Cách update

```
composer update luatdolphin/lang-vietnamese 
php flarum cache:clear
```

### Cách cài đặt thông thường

1. Tải [phiên bản mới nhất tại](https://github.com/luatdolphin/lang-vietnamese/releases) (hoặc [tải phiển bản đang phát triển mới nhất tại](https://github.com/luatdolphin/lang-vietnamese/archive/master.zip)).
2. Giải nép file bằng [a file archiver](https://en.wikipedia.org/wiki/Comparison_of_file_archivers).
3. Truy cập vào server của bản qua [FTP](https://en.wikipedia.org/wiki/File_Transfer_Protocol), [SSH](https://en.wikipedia.org/wiki/Secure_Shell) hoặc trình quản lý của bạn.
4. Mở file *composer.json* của Flarum sau đó thêm dòng "luatdolphin/lang-vietnamese": "^0.1.0@beta" bao gồm dấu nháy kép "" sau dòng *"require": {* rồi lưu lại
5. Chuyển qua thư mục *vendor/* tại mục cài đặt của Flarum.
6. Tạo mới thư mục con *luatdolphin/lang-vietnamese/*  trong thư mục *vendor/* .
7. Tải nội dung ngôn ngữ mà bạn vừa giải nén vào thư mục. (*composer.json, extend.php....*)
8. Quay lại thư mục gốc chứa file *composer.lock* thêm dòng bên dưới vào sau phần *"time":" thời gian " },* của extension trước đó rồi lưu lại.
```
       {
            "name": "luatdolphin/lang-vietnamese",
            "version": "v0.1.0-beta.9",
            "source": {
                "type": "git",
                "url": "https://github.com/luatdolphin/lang-vietnamese.git",
                "reference": "b75296761d712f9d1804dae1a0e2039656d0d50d"
            },
            "dist": {
                "type": "zip",
                "url": "https://api.github.com/repos/luatdolphin/lang-vietnamese/zipball/b75296761d712f9d1804dae1a0e2039656d0d50d",
                "reference": "b75296761d712f9d1804dae1a0e2039656d0d50d",
                "shasum": ""
            },
            "require": {
                "flarum/core": "^0.1.0-beta.9"
            },
            "type": "flarum-extension",
            "extra": {
                "branch-alias": {
                    "dev-master": "0.1.x-dev"
                },
                "flarum-extension": {
                    "title": "Vietnamese",
                    "icon": {
                        "image": "icon.svg",
                        "backgroundColor": "#00247d",
                        "backgroundSize": "cover",
                        "backgroundPosition": "center"
                    }
                },
                "flarum-locale": {
                    "code": "vi",
                    "title": "Vietnamese"
                }
            },
            "notification-url": "https://packagist.org/downloads/",
            "license": [
                "MIT"
            ],
            "description": "Vietnamese language pack.",
            "keywords": [
                "locale",
                "vietnam",
                "vietnamese"
            ],
            "time": "2019-08-30T03:19:37+00:00"
        },
```
