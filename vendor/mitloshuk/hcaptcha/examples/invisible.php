<?php
include_once __DIR__ . '/check.php';
?>

<html>
<head>
    <title>hCaptcha visible test form</title>
</head>

<body>
<form id="hcaptcha-form" action="" method="post">
    <div>
        This site is protected by hCaptcha and its
        <a href="https://hcaptcha.com/privacy">Privacy Policy</a> and
        <a href="https://hcaptcha.com/terms">Terms of Service</a> apply.
    </div>

    <button class="h-captcha"
            data-sitekey="10000000-ffff-ffff-ffff-000000000001"
            data-callback="onSubmit"
            data-size="invisible">
        Check it!
    </button>
</form>

<script src="https://hcaptcha.com/1/api.js" async defer></script>
<script type="text/javascript">
    function onSubmit(token)
    {
        document.getElementById('hcaptcha-form').submit();
    }
</script>
</body>
</html>