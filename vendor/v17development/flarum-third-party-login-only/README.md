# 📰 Flarum Third Party Login only 
Only allow login and sign ups from oAuth extensions.

If you have any feedback, let us know! Do you experience issues? You can report issues on the Flarum Forum or on [GitHub](https://github.com/v17development/flarum-third-party-login-only).

##  ℹ️ When to use this extension?
To be clear, this extension **does not add** oAuth to your Flarum instance but instead disables the `Sign In` and `Sign Up` password-forms for a better authenticating flow user experience. Use [FoF Passport](https://discuss.flarum.org/d/5203) or [FoF oAuth](https://discuss.flarum.org/d/25182) to add oAuth to your forum.

This extension is suitable for organizations or communities that only want to allow sign-in and sign-ups with external oAuth accounts/providers.

## 📥 Installation
If you like to install this extension, run the following command:
```
composer require v17development/flarum-third-party-login-only
```

## ♻ Updating
Run the following command on your server to update the plugin
```
composer update v17development/flarum-third-party-login-only
```

## 🦸 Features
- Disables `/login`, `/api/login` and removes login form
- Disables `/register` if there's no oAuth-sign-in `token` and removes registration form
- Disables `/reset` & `/api/forgot` routes and removes password reset form
- Managing new signups via oAuth extensions is still possible with the `Allow signups` permission
- Makes it possible to add a welcome message for new users

## Knowledge base articles:
- [Replacing Sign In and Sign Up button](https://community.v17.dev/knowledgebase/41)
- [Authenticating new accounts](https://community.v17.dev/knowledgebase/44)
- [Change and reset password links](https://community.v17.dev/knowledgebase/43)
- [Allow users to change their email](https://community.v17.dev/knowledgebase/42)

## 🔨 Works with:
- [FriendsOfFlarum Passport](https://discuss.flarum.org/d/5203)
- [FriendsOfFlarum oAuth](https://discuss.flarum.org/d/25182)

## 🙋 Questions, feedback?
If you have any questions related to this extension, don't hesistate and reply to this topic or [open an issue](https://github.com/v17development/flarum-third-party-login-only/issues).

## ❤️ Sponsored by Buttonizer
This extension is sponsored by [Buttonizer](https://buttonizer.pro/).

## 🖼️ Screenshots

### Sign In window
After activating this extension, the sign in form is removed, only oAuth buttons are visible. The "Forgot password" link is only visible when a "Forgot password link" is set-up.

If the `Replace Sign In and Sign Up button` setting is enabled, the `Log in` window will not be visible and automatically opens the FoF Passport oAuth sign in window.

![Sign in](https://i.imgur.com/DzMl1cx.png)

### Custom Sign Up text
If set, a custom welcome text will be visible after authenticating with new accounts.
[![Sign Up](https://i.imgur.com/cuOIadi.png)](https://imgur.com/a/ix87nkM)

### Admin settings
[![Admin settings](https://i.imgur.com/oQOsMb7.png)](https://imgur.com/a/ix87nkM)
