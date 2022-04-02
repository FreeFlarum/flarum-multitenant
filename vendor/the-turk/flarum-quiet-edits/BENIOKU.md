# Sessiz Düzenlemeler

[![MIT lisansı](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/the-turk/flarum-quiet-edits/blob/master/LICENSE) [![Son Stabil Sürüm](https://img.shields.io/packagist/v/the-turk/flarum-quiet-edits.svg)](https://packagist.org/packages/the-turk/flarum-quiet-edits) [![Toplam İndirme](https://img.shields.io/packagist/dt/the-turk/flarum-quiet-edits.svg)](https://packagist.org/packages/the-turk/flarum-quiet-edits)

Bu eklentiyi kullandığınızda mesaj gönderildikten sonra ek süre içinde yapılan düzenlemeler, düzenleme olarak sayılmaz. Ayrıca büyük/küçük harflerdeki ya da boşlukla ilgili değişiklikleri de yok sayabilirsiniz.

- [jfcherng/php-diff](https://github.com/jfcherng/php-diff) tabanlıdır.
- Geliştiriciler için `PostWasRevisedQuietly` ve `PostWasRevisedLoudly` olmak üzere iki yeni olay ekledim.

![Ayarlar](https://i.imgur.com/MZNqmCR.png)

## Gereksinimler

![php](https://img.shields.io/badge/php-%5E7.1.3-blue?style=flat-square) ![ext-iconv](https://img.shields.io/badge/ext-iconv-brightgreen?style=flat-square)

php sürümünüzü `php -v` komutunu çalıştırarak ve `iconv` pakedinin yüklü olup olmadığını `php --ri iconv` komutunu çalıştırarak (`iconv support => enabled` çıktısını görmelisiniz) öğrenebilirsiniz.

## Kurulum

```bash
composer require the-turk/flarum-quiet-edits
```

## Güncelleme

```bash
composer update the-turk/flarum-quiet-edits
php flarum cache:clear
```

## Kullanım

Eklentiyi aktif edin. Ek süre varsayılan olarak 120 saniyedir ve yine varsayılan olarak büyük/küçük harflerdeki ya da boşlukla ilgili değişiklikler yok sayılır.

## Bağlantılar

- [Flarum tartışma konusu](https://discuss.flarum.org/d/22916-quiet-edits)
- [GitHub üzerindeki kaynak kodu](https://github.com/the-turk/flarum-quiet-edits)
- [Değişiklikler](https://github.com/the-turk/flarum-quiet-edits/blob/master/CHANGELOG.md)
- [Sorun bildir](https://github.com/the-turk/flarum-quiet-edits/issues)
- [Packagist aracılığıyla indir](https://packagist.org/packages/the-turk/flarum-quiet-edits)