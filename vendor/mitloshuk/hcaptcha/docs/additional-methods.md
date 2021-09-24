Back to [request verification](verification.md)

---

Additional methods
------------

#### Raw (json) response

You can get raw (json) response from hcaptcha with

```
$hCaptchaResponse->getRaw()
```

#### Array response

If you need response converted to array, use

```
$hCaptchaResponse->getArray()
```

#### Errors

If you need to know errors just get it via

```
$hCaptchaResponse->getErrors()
```

that returns array of errors, when `isSuccess` is `false` and `null` when it is `true`

#### Challenge date

From `$hCaptchaResponse` you also can get challenge date via

```
$hCaptchaResponse->getDate()
```

#### Challenge hostname

Hostname via

```
$hCaptchaResponse->getHostname()
```

#### Is challenge credited

Credit value `true/false` via

```
$hCaptchaResponse->isCredit()
```

---

Next to [examples and playground](playground.md)