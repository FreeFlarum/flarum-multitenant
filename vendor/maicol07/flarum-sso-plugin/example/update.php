<?php /** @noinspection ForgottenDebugOutputInspection */

use Dotenv\Dotenv;
use Illuminate\Support\Arr;
use Maicol07\SSO\Addons\Groups;

// Note: Since this is called from the example folder, the vendor folder is located in the previous tree level
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env
$env = Dotenv::createImmutable(__DIR__);
$env->load();

if (Arr::exists($_POST, 'username')) {
    require_once __DIR__ . '/flarum.php';
    /** @var $flarum <-- Fix PHPStorm hints */

    // Create the user to work with
    $flarum_user = $flarum->user(Arr::get($_POST, 'username'));

    // Check if user exists in flarum
    if (!empty($flarum_user->id)) {
        // Set his attributes (from form)
        $flarum_user->attributes->nickname = Arr::get($_POST, 'nickname');
        $flarum_user->attributes->avatarUrl = Arr::get($_POST, 'avatar');
        $flarum_user->attributes->bio = Arr::get($_POST, 'bio');

        // Let's add to it some groups (optional, only for demonstration)
        // First, let's add the Groups addon (note that the Groups class is imported at the top with the use statement)
        $flarum->loadAddon(Groups::class);
        $flarum->setAddonProperties(Groups::class, ['set_groups_admins' => env('SET_GROUPS_ADMINS') ?? true]);
        // Then, add the groups (as an array) to the correct attribute in user relationships
        $flarum_user->relationships->groups = ['Premium', 'Novice'];

        // Update the user
        $success = $flarum_user->update();

        // Redirect to Flarum
        if (!empty($_GET['redirect'])) {
            $flarum->redirect();
        }
    } else {
        $success = false;
    }
} elseif (!empty($username) || !empty($password)) {
    $success = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Lightweight CSS only to make this page beauty -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css"
          integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="box" style="margin-top: 25px;">
        <h1 class="title">Update user</h1>

        <form method="post">
            <p class="mb-3">Note: This is only a test, so the infos you can edit here are limited!</p>
            <div class="columns">
                <div class="column">
                    <label class="label" for="username">Username (doesn't change)</label>
                    <input id="username" type="text" class="input" name="username" placeholder="Username">

                    <label class="label" for="nickname">Nickname</label>
                    <input id="nickname" type="text" class="input" name="nickname" placeholder="Nickname">
                </div>
                <div class="column">
                    <label class="label mt-3" for="avatar">Avatar URL</label>
                    <input id="avatar" type="url" class="input" name="avatar" placeholder="Avatar URL">

                    <label class="label mt-3" for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="textarea" placeholder="Update user bio"></textarea>
                </div>
            </div>
            <button class="button is-centered is-center" type="submit" style="display: block; margin: 0 auto;">Update
            </button>
        </form>

        <?php if (isset($flarum) and !empty($success)) { ?>
            <div class="notification is-success">
                <button class="delete"></button>
                Successfully updated! Click the button below to go to Flarum user!
                <br>
                <a class="button is-rounded mt-5"
                   href="<?php echo $flarum->url . (isset($_POST['username']) ? "/u/{$_POST['username']}" : '') ?>"
                   style="display: block; margin: 0 auto; width: max-content;">
                    Go to user in Flarum
                </a>
                <details>
                    <summary>User details</summary>
                    <pre style="margin: 16px 0;">
                        <?php
                        if (isset($flarum_user) and $flarum_user->fetch()) {
                            $is_admin = $flarum_user->isAdmin ? 'Yes' : 'No';
                            echo "User ID: $flarum_user->id<br>Is user admin? <b>$is_admin</b><br>User attributes: <br>";
                            var_export($flarum_user->getAttributes());
                            echo "<br>User relationships: <br>";
                            var_export($flarum_user->getRelationships());
                        } else {
                            echo "Can't fetch user from Flarum!";
                        }
                        ?>
                    </pre>
                </details>
            </div>
        <?php } elseif (isset($success) and empty($success)) { ?>
            <div class="notification is-danger">
                <button class="delete"></button>
                Update failed
            </div>
        <?php } ?>
    </div>
</div>

<?php require_once 'footer.php' ?>
</body>
</html>
