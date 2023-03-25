<?php /** @noinspection DuplicatedCode */

use Dotenv\Dotenv;

// Note: Since this is called from the example folder, the vendor folder is located in the previous tree level
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env
$env = Dotenv::createImmutable(__DIR__);
$env->load();

require_once __DIR__ . '/flarum.php';
/** @var $flarum <-- Fix PHPStorm hints */

// Delete the user
$success = $flarum->user($_GET['username'])->delete();

if (!empty($_GET['redirect'])) {
    $flarum->redirect();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Lightweight CSS only to make this page beautiful -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css"
          integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
</head>
<body class="container">
<div class="box" style="margin-top: 25px;">
    <h1 class="title">Delete user</h1>

    <?php if (isset($flarum) and !empty($success)) { ?>
        <div class="notification is-success">
            <button class="delete"></button>
            <?php echo "Successfully deleted {$_GET['username']}"; ?><br>
        </div>
    <?php } elseif (isset($flarum) and empty($success)) { ?>
        <div class="notification is-danger">
            <button class="delete"></button>
            <?php echo "Something went wrong while deleting {$_GET['username']} :("; ?><br><br>
            Check if one of this common error cases has occurred:
            <ul>
                <li>Username has not been typed correctly</li>
                <li>User does not exists in Flarum</li>
            </ul>
        </div>
    <?php } ?>
    <details>
        <summary>Users list</summary>
        <ul>
            <li><?php echo implode('</li><li>', $flarum->getUsersList('attributes.username')->all()); ?></li>
        </ul>
    </details>
</div>

<?php require_once 'footer.php' ?>
</body>
</html>
