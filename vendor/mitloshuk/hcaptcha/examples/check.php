<?php

use HCaptcha\hCaptcha;

include_once __DIR__ . '/../vendor/autoload.php';

$hCaptcha = new hCaptcha('0x0000000000000000000000000000000000000000');

if (isset($_POST['h-captcha-response'])) {
    $hCaptchaResponse = $hCaptcha->verify($_POST['h-captcha-response']);

    if ($hCaptchaResponse->isSuccess()) {
        echo 'Congratulations! You are human';
    } else {
        echo 'We think you are robot, because ' . implode(',', $hCaptchaResponse->getErrors());
    }

    exit;
}