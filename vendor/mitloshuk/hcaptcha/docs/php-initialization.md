Back to [HTML initialization](html-initialization.md)

---

PHP initialization
------------

#### Initialize hCaptcha

```
$hCaptcha = new hCaptcha('your-secret-key');
```

#### Custom request method

If you do not want to use `curl` for requests, you should create your own class that implements `RequestInterface` and use it like that

```
$hCaptcha = new hCaptcha(
    'your-secret-key',
    (new YourOwnRequest())
);
```

Read about [hcaptcha checking]()

---

Next to [request verification](verification.md)