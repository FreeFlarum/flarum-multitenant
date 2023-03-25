<?php
// Create the Flarum object with the required configuration. The parameters are explained in the class file (src/Flarum.php)
use Maicol07\SSO\Flarum;

$flarum = new Flarum([
    'url' => env('FLARUM_HOST', 'https://discuss.flarum.org'),
    'root_domain' => env('ROOT_DOMAIN', 'flarum.org'),
    'api_key' => env('API_KEY', 'NotSecureToken'),
    'password_token' => env('PASSWORD_TOKEN', 'NotSecureToken'),
    'remember' => $_POST['remember'] ?? false,
    'verify_ssl' => env('VERIFY_SSL', true),
    'set_groups_admins' => env('SET_GROUPS_ADMINS', true)
]);
