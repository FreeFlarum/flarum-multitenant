Next to [PHP initialization](php-initialization.md)

---

Verification
------------

#### Verify data with hCaptcha

After request to hCaptcha services, it will return `Response` class
     
 ```
 $hCaptchaResponse = $hCaptcha->verify($_POST['h-captcha-response'])
 ```
 
#### Check response

After getting of response, simply check it with
     
 ```
 if ($hCaptchaResponse->isSuccess()) {
     echo 'Congratulations! You are human';
 }
 ```
 
---
 
Next to [additional methods](additional-methods.md)