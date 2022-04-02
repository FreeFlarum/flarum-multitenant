Back to [navigation](_navigation.md)

---

HTML initialization
------------

#### API Site key and Secret

Go to https://dashboard.hcaptcha.com, sign in and make new site if you do not have it yet

#### HTML

Include hCaptcha `api.js` at end of body
```
<script src="https://hcaptcha.com/1/api.js" async defer></script>
```

#### For visible captcha add to form

```
<div class="h-captcha" data-sitekey="your-site-key"></div>
```

#### For **invisible** captcha change your submit button of form to

```
<button class="h-captcha"
        data-sitekey="your-site-key"
        data-callback="onSubmit"
        data-size="invisible">
    Check it!
</button>
```

And at after `api.js` script

```
<script type="text/javascript">
    function onSubmit(token)
    {
        document.getElementById('hcaptcha-form').submit();
    }
</script>
```

More info in [examples](https://github.com/mitloshuk/hcaptcha/tree/master/examples) and on [hCaptcha docs page](https://docs.hcaptcha.com)

---

Next to [PHP initialization](php-initialization.md)