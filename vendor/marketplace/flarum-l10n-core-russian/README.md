# Information / Информация

Пакет русской локализации движка [**Flarum**](https://flarum.org/) - программного обеспечения нового поколения для создания сообществ. Реализована поддержка единичных и множественных чисел (переменных). Все фразы взяты в двойные кавычки для предотвращения конфликтов со знаками препинания, потому что их в русском языке используется большее количество, по сравнению с английским.

## Install / Установка

**Flarum** использует [**Composer**](https://getcomposer.org/) для управления зависимостями и расширениями.

Русский пакет локализации доступен в [**Packagist**](https://packagist.org/packages/marketplace/flarum-l10n-core-russian) и может быть установлен при помощи **Composer**.

Убедитесь, что **Composer** установлен на вашем компьютере, и введите следующую команду в терминале, находясь в корневой директории **Flarum**:

```
composer require marketplace/flarum-l10n-core-russian
```

Так же, данная команда может быть использована для обновления языкового пакета, без обновления сторонних компонентов.

Обратите внимание, что пакет локализации будет добавлен в качестве зависимости **Flarum**, и он также будет автоматически обновляться при обновлении движка форума.

## Update / Обновление

Для обновления локализации необходимо выполнить следующие команды:

```
composer update marketplace/flarum-l10n-core-russian
php flarum cache:clear
```

## Donation / Пожертвование

- [Donation Form](https://donation-form.github.io/)