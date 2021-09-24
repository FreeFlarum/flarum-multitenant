<?php
include_once __DIR__ . '/check.php';
?>

<html>
<head>
    <title>hCaptcha visible test form</title>
</head>

<body>
<form id="hcaptcha-form" action="" method="post">
    <div class="h-captcha" data-sitekey="10000000-ffff-ffff-ffff-000000000001"></div>

    <button type="submit">Check me!</button>
</form>

<script src="https://hcaptcha.com/1/api.js" async defer></script>
</body>
</html>