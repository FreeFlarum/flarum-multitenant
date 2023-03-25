# Flarum Database Requirements

This is a library re-used across multiple KILOWHAT extensions to ensure the database requirements are met before an extension can be enabled.

It will not appear in the Flarum admin panel.

There is currently a single feature: ensure the JSON column type is supported by the database.

To use in an extension, create a new migration that executes before all other extensions with the following code (where `vendor-name` is the internal Flarum extension ID for your extension):

```php
<?php

use Kilowhat\DatabaseRequirements\Migration;

return Migration::ensureJsonColumnSupport('vendor-name');

```

To work around false positives, the `kilowhat.ignore-mysql-requirement` key can be set to `true` in `config.php`.

After the migration have run, the requirements will not be checked again.
