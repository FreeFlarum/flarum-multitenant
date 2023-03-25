# Changelog


<a name="3.1"></a>
## [3.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/3.0.1...3.1)

> Released on October 01, 2022

### ✨ Features
- [`b923d57`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b923d5714300ef64b727acdd127d523b189585f8) ✨ Added ability to specify the cookie name prefix
  
      - Standardized the PHPDoc
  
  ### 🐛 Bug Fixes
- [`fff7f46`](https://github.com/maicol07/flarum-sso-php-plugin/commit/fff7f46d1c46f4fc2635cf47e1088f7dd0047ae4) Fix API docs action config file path
  - [`3aad2d5`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3aad2d5d3d5db6905446f78246d4a81317befe67) Fix API docs action name
  - [`282fc5c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/282fc5c35b7ca5fb900b778b0cbb7f671379dac5) upgrade bootstrap from 4.5.2 to 4.6.0
  
      Snyk has created this PR to upgrade bootstrap from 4.5.2 to 4.6.0.
    
    See this package in npm:
    https://www.npmjs.com/package/bootstrap
    
    See this project in Snyk:
    https://app.snyk.io/org/maicol07/project/14ec3470-1b32-45eb-bbcd-6750c6ff2cb5?utm_source=github&utm_medium=upgrade-pr
  
  ### Other changes
- [`f701ef4`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f701ef4b3d0f0dcf4a9d233e369f716010808569) 👷 Added API docs action
  - [`fcf2d86`](https://github.com/maicol07/flarum-sso-php-plugin/commit/fcf2d86afad76a72f1e2a92a2112c010650d58c5) 👷 Added changelog generator action
  - [`d9a76dd`](https://github.com/maicol07/flarum-sso-php-plugin/commit/d9a76dd05711597b46d13d12beea06624ca57108) Delete issue template
  - [`85938c3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/85938c3bfd24e21ef51152ee7f71fe5e69d0ef03) Don't allow new issues on Github
  - [`f3ed428`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f3ed4281601ddc232bb2cbb4beffc49e7765a533) **deps:** Support Laravel 9
  
  ### 🔀 Pull Requests

- [`b79a144`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b79a144400fbad53a55950d842eecb5a260f2394) Merge pull request [#23](https://github.com/maicol07/flarum-sso-php-plugin/issues/23) from maicol07/snyk-upgrade-de94e331fd0de516aa6ee2b157279c87
  
      [Snyk] Upgrade bootstrap from 4.5.2 to 4.6.0
  
  
<a name="3.0.1"></a>
## [3.0.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/3.0...3.0.1)

> Released on May 22, 2021

### 🐛 Bug Fixes
- [`0dd2465`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0dd2465d90f093cb18f889dad55de8da552d6275) 🐛 Groups created even if they already exists in Flarum
  
  ### 📝 Docs changes
- [`30734d1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/30734d1efbb81e514d776742c21f761096fc7460) 📝 Updated API Docs for 3.0.1
  
  ### 👷 Building scripts changes
- [`0ac8531`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0ac8531615189675827f8d39f0316b42d04cb70b) **changelog:** 👷 Fixed changelog generation config
  
  ### Other changes
- [`f3c9c50`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f3c9c505336bd5ccd5081170f2dfdc9fb9b44244) 🔥 Removed set_groups_admins as no more used
  
      Implementation of this should be made by the user
  
  
<a name="3.0"></a>
## [3.0](https://github.com/maicol07/flarum-sso-php-plugin/compare/2.0...3.0)

> Released on April 09, 2021

### ✨ Features
- [`d173cb1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/d173cb1c2b6c5e048567f167a65d02e141456d5d) ✨ Addons can now specify what addons are required to be loaded before it
  - [`c0dc540`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c0dc5403ee64a9e89140def8ba81167b1b0b74c4) ✨ Allow to change the remember property via the `isSessionRemembered` method
  - [`f152d95`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f152d950cb79ca9af033a232b02c6126f6aae89c) ✨ 💥 New user() method
  
      - Replaces the current user object creation
    - User property is now private. You can only access to the user via this method
    - Improved examples
  - [`99c0594`](https://github.com/maicol07/flarum-sso-php-plugin/commit/99c059459d1f264fd4c15d6162a7fbcef697e2d8) 💥 ✨ 🚚 Moved Addons and Cookies features to traits
  
      - Removed class cookie. Now all the necessary cookies are generated on the fly.
    - Addons initialization in the constructor is moved to the initAddons() method in the Addons trait.
    - Login: now the logout cookie is deleted (if it exists), the session token or remember token is created
    - Logout: now the session token and remember token cookies are deleted (if they exist), a new logout cookie (flarum_logout) is created.
    
    New methods:
    - setRememberCookie
    - deleteRememberCookie
    - setSessionTokenCookie
    - deleteSessionTokenCookie
    - setLogoutCookie
    - deleteLogoutCookie
    - generateCookie
    
    Renamed methods:
    - addAddon is now loadAddon
    - removeAddon is now unloadAddon
    
    Removed methods:
    - setCookie
    
    BREAKING CHANGE
  - [`613b5b5`](https://github.com/maicol07/flarum-sso-php-plugin/commit/613b5b5317a174b74199c28e94a4515fb992f4fa) ✨ Added Remember me checkbox to example + some visual improvements
  - [`5865c51`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5865c51d8ae57ace218d8c6648afd0612902d4ce) ✨ Changed `lifetime` to `remember`
  
      Lifetime is deprecated in beta16.
    Remember should be set to true when you want to login the user with a "Remember me" option.
  - [`edd34eb`](https://github.com/maicol07/flarum-sso-php-plugin/commit/edd34eb1356fe28baf77c54be1b69b8cb0e2bcbe) ✨ Initial attempt to beta16 compatibility
  
      - BREAKING CHANGE: 💥 Replaced the `lifetime` setting with `remember`
    - BREAKING CHANGE: 💥 Removed the `getLifeTimeSeconds` method
    - BREAKING CHANGE: 💥 PHP 7.3 required
    - WARNING! illuminate/support pinned to ^8 (removed support for Laravel 6 & 7)
  
  ### 🔄 Updates
- [`443658d`](https://github.com/maicol07/flarum-sso-php-plugin/commit/443658d6ca64b7a22a443866a82f8361434f8096) 🔥 Removed the getForumLink
  
      URL is accessible via the url property
  - [`3f31ea6`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3f31ea614a15c9e409f6cd31dc0792801788b377) ✨ Updated user `update` method
  
      - ✨ Added check if id is set. If not set, it will be fetched automatically.
    - ✨ Response is now saved and passed as argument to the after_update method hook.
    - ✨ The method now returns a bool. True if the user has been updated (the response correctly reports the user id); false if the user can't be fetched (if the user id doesn't exists) or the response id is different from user id
  - [`7b14a69`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7b14a69e8b8853096a90e560957423f656d80ffa) 🚚 💥 Renamed the `fetchUser` method to simply `fetch`
  - [`e9c1c9e`](https://github.com/maicol07/flarum-sso-php-plugin/commit/e9c1c9ed309ead47182e465284900c042f4edca4) 🚚 Moved and Renamed the Basic trait to the Auth trait in the Maicol07\SSO\User\Traits namespace
  - [`80d1f7e`](https://github.com/maicol07/flarum-sso-php-plugin/commit/80d1f7eb6991b195eb2dcd2ee4438345cf9e1937) Minor improvements
  - [`c1e71eb`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c1e71eba648d64c2607eb4b7f3e1ea64db0fcc41) **addons:** 🚚 Renamed master property to flarum (consistency)
  - [`e886c59`](https://github.com/maicol07/flarum-sso-php-plugin/commit/e886c596b6e6bdc9c8cf3543bffb732617c8e118) **example:** Updated example
  - [`204e0a2`](https://github.com/maicol07/flarum-sso-php-plugin/commit/204e0a26d33e76c541d11c93d92a8e3f27537301) **examples:** ✨ Added users list on the delete page
  
  ### 🐛 Bug Fixes
- [`6c262d8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6c262d898f3ccc68ee20a93dbd0c12ebe4182236) 👽 Nickname attribute instead of display name
  
  ### 🚚 Renamed
- [`768152a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/768152a6cd531f7b8d460c0177352b3ad275e172) **addons:** 🚚 `setAddonAttributes` renamed to `setAddonProperties`
  
  ### ♻ Code Refactoring
- [`7f5f752`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7f5f752005d6645194a8445b0bdc7cb6e20453a6) ♻️ 🚚 Moved delete and update methods out of the basic trait
  - [`e3c00de`](https://github.com/maicol07/flarum-sso-php-plugin/commit/e3c00dede0d2ee171e9a1a0d09a5dbcbf5601b40) ♻️ Refactor doctum.config.php
  - [`a72432d`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a72432d75f7b0b5c930fad708fcda143b0613347) ♻️ Refactor doctum.config.php
  - [`6331b3c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6331b3c2fc92746c85a6e2bb8a9c6b931eceb8f2) ♻️ General refactor
  
  ### 🎨 Code styling
- [`1b6448b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/1b6448bd8f3a79c609e07c05ef8958735386ac4e) 💄 Minor example styling improvement
  
  ### 📝 Docs changes
- [`2b2dcb3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/2b2dcb38b547443bfb73a72399fe4079a4ebd14b) 📝 Updated docs
  - [`94a2a84`](https://github.com/maicol07/flarum-sso-php-plugin/commit/94a2a84d3e270190c2ad4d3adfe26dd9c26e700b) 📝 Updated docs
  - [`37ce682`](https://github.com/maicol07/flarum-sso-php-plugin/commit/37ce682eadd9a4e2ee1fc24c3af49499909f8d06) 📝 Updated docs
  
      Now using doctum with a modified version of the Flarum docs theme
    - 🙈 Updated .gitignore
  - [`7b7cbb8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7b7cbb8d95eb4ec2c37b32ae98842cd8c1ad541f) 📝 PHPDoc fix
  
  ### 👷 Building scripts changes
- [`56c12d7`](https://github.com/maicol07/flarum-sso-php-plugin/commit/56c12d729157c02c589ac78baa2ea00b4a3b5434) **changelog:** 👷 Added changelog
  
  ### 🔀 Pull Requests

- [`befa080`](https://github.com/maicol07/flarum-sso-php-plugin/commit/befa08099f3818c9c2e57ffec26a55c05ebd40ce) Merge pull request [#9](https://github.com/maicol07/flarum-sso-php-plugin/issues/9) from richstandbrook/patch-1
  
      feat: ✨ Be able to programmatically signup users
  
  
<a name="2.0"></a>
## [2.0](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.2.2...2.0)

> Released on November 02, 2020

### ✨ Features
- [`19fa6cc`](https://github.com/maicol07/flarum-sso-php-plugin/commit/19fa6cc6def4d5631c0078553f8f783c252907c1) Fetch user data from Flarum
  - [`31089ae`](https://github.com/maicol07/flarum-sso-php-plugin/commit/31089ae848eb9f7d2aa06349a58d3256f7df69e6) Support multiple arguments for hooks actions
  - [`b955432`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b955432a06305f0a6875ea7c9bd22fed27afca92) ✨ Added missing default attributes
  - [`264af5d`](https://github.com/maicol07/flarum-sso-php-plugin/commit/264af5df64a9d0be9f8440d5086032097b55b0d4) ✨ New User class and properties classes
  
      FILES
    - Added a new User Class. This automatically fetch the user and initializes it with Flarum database info
    - Added new Attributes and Relationships classes
    BASIC TRAIT
    - [BREAKING CHANGE] Bundled to the user class, not to Flarum one
    - ♻️ General refactor
    - 🚚 Moved the `getUsersList` function to the Flarum class
    - 🚚 Moved the `getLifeTimeSeconds` to the Basic Trait
    BUNDLED ADDONS
    - [BREAKING CHANGE] Groups: 🔥 Removed `removeGroups()` function. Edit the User manually and then update him
    - Groups: Groups now will be updated when using the `update()` function
  - [`0027f3e`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0027f3e7fa7716454ce454a7115603d50dacc785) ✨ Hooks/Addons system
  
      This way it is possible to split features across modules.
    The new Traits folders includes Basic features
  
  ### ⚡ Performance Improvements
- [`02a22f9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/02a22f931fd6e5e687ccce6056177bdbcd3ceac6) ⚡️ Avoid unnecessary request
  
  ### 🐛 Bug Fixes
- [`c6e6adb`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c6e6adb56b8f9f46752dc0fbf9d3c6b5af355aa4) Groups don't get added to the user
  - [`f913e74`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f913e74b5402482c2613dc329f189c5aab5c181f) Load namespaces in composer autoloader
  - [`1ce51e4`](https://github.com/maicol07/flarum-sso-php-plugin/commit/1ce51e4ec6e1260d78353a73aa8e96a99a17f955) 🐛 Warnings when username is null
  - [`5e99f70`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5e99f70e54f8e23b86b2247b948b3b3ad3b88603) Replace methods
  - [`be32b36`](https://github.com/maicol07/flarum-sso-php-plugin/commit/be32b36747fca430f1cb31ddb8a36f8c1bd17472) 🐛 Attributes and relationships not initialized
  - [`50bc982`](https://github.com/maicol07/flarum-sso-php-plugin/commit/50bc982f3880d8ae8578a436fb00ce3f5e1b17bc) 🐛 Redirect not working when no scheme was specified
  
      Example before this fix:
    example.com --> NOT WORKING
    https://example.com --> WORKING
    
    After the fix:
    example.com --> BECOMES https://example.com --> WORKING
    https://example.com --> WORKING
  - [`cf2be12`](https://github.com/maicol07/flarum-sso-php-plugin/commit/cf2be127b5e5aa74fd2fad1f31cb50154b0690c4) 🥅 Exception if user does not exists in Flarum
  
      - Also added a new hook action
  - [`0d9c12e`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0d9c12ea655a894ad35c09dc797bb4faf91b1aa6) last commit fixes
  - [`daeaf04`](https://github.com/maicol07/flarum-sso-php-plugin/commit/daeaf04317c9a183e98e15be078bf08ec4b14a56) ✏️ Typos
  - [`ff7c262`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ff7c26263b77a41b112cac33b3994303dc17af7f) ✏️ Typos
  - [`6ec4a91`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6ec4a916da70262c5afc88caf33e1a509a5194bc) **deps:** 📌 Can't allow installations
  - [`6ca94d3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6ca94d3bce7471f4f633a73b9ee620166f9f11c9) **deps:** 📌 Can't allow installations
  
  ### ♻ Code Refactoring
- [`b2d029b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b2d029bc787f6e0d1239ef13786d86c0cdf11ab5) ♻️ Refactored comments
  - [`f31f07d`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f31f07d0d943b463da96c391480386e0dc4aa5c0) 🚚 Moved `setDomain()` method
  - [`7766209`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7766209b532f6c80d027ec9271fa8c8c2950cf9d) :recycle: General refactor
  
  ### 📝 Docs changes
- [`5a764bc`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5a764bc4a8ee669e188bd895c2863d6df734fbfe) Added missing docs
  - [`c5ffd73`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c5ffd73ad7e91e870b490f4abeb4da83a804db24) 📝 Updated example to add groups
  - [`7ed7e78`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7ed7e78fb79a732d9ba1fbf56d1ff107e7b7506c) 📝 Updated docs and examples
  - [`6b5e92c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6b5e92c2c4841a2f845e3cfd4ebc1626a62cf184) Updated API Docs
  - [`cc04d97`](https://github.com/maicol07/flarum-sso-php-plugin/commit/cc04d979c74d11141b7acb99780a494cc2afa36d) Added packages to every class
  - [`0a4a97a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0a4a97ae684e10509fb3cf78708d4fa051054889) Added env to example
  - [`ff3558f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ff3558f73444717704e18745dcbf75bf6fac1e91) 📝 Updated docs
  - [`197ebf0`](https://github.com/maicol07/flarum-sso-php-plugin/commit/197ebf0d82fd8555db77e8858f7a3d12ea715ae0) Updated API Docs
  
      - New design!
    - Updated to the new features!
  - [`96e99b3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/96e99b34e6d0fc887d73ef84818ad40c90ccae24) Updated example
  
      - Added some HTML markup and CSS to examples
    - Updated to new plugin features
  
  ### Other changes
- [`996b9db`](https://github.com/maicol07/flarum-sso-php-plugin/commit/996b9db534cff0ed548fbb9db6d03165061e6c6c) Fixed links
  - [`cc0864a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/cc0864a9ccfb04185fab3677631438ee80f8c0bf) Removed unused packages
  - [`8f81cc7`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8f81cc71c8cc1a2acd8fbc6034753121cc87c18b) Moved set_groups_admins to Groups addon
  - [`3ed03f1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3ed03f132397e1dd16f123b343f9e07895f7493d) Moved set_groups_admins to Groups addon
  - [`ad50268`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ad5026869c8e7ccc3db4eb0834372247324a2f9c) improved ssl verification
  
      BREAKING CHANGE: changed option name and behaviour
  - [`f01e4bb`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f01e4bb0bf700adf167e52594868117f3ff22237) Improved group search
  - [`68df590`](https://github.com/maicol07/flarum-sso-php-plugin/commit/68df59024cab8469d33f5b95bf6b7e99f6a2cf54) Changed `addAddon` return and `setAddonAttributes`
  - [`f9652ea`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f9652eaaac3c552177c45cee66e932e0d210cf31) 🚚 Moved cookie saving to its own method
  - [`23136fa`](https://github.com/maicol07/flarum-sso-php-plugin/commit/23136fa021b3c51c937e3e918cb69e6afba6e86e) Changed method visibility
  - [`a676033`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a6760336cfade7684054c890ebd92ad9210451b7) 📄 Wrong license
  - [`40b3924`](https://github.com/maicol07/flarum-sso-php-plugin/commit/40b3924383f9d17e769e8234ec37cc3da63fe402) Add username on init
  - [`a4481a3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a4481a3780dac12b77d154e0002f45474782a9ba) Updated composer.json
  - [`15a409a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/15a409ad3a16c7efa793c63ed9f861879ba0acbb) Updated composer.json
  - [`b6accc9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b6accc998f51f2f1e689fc3005bc28a5c9f602b0) Improvements to actions and filters
  
      - Returns -1 if hook/filter does not exist
    - Added login and register replacer
  - [`6aee96a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6aee96a4c7684f791edf4ccb6990bafb6252e80b) 🔥 Removed cookie removal
  
      - Linked to 1ea3d15456e643f893cda609df2e6195f8352143
    - Tracker issue: #FSSOE-1
  - [`ac9a9be`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ac9a9bef3e3dfbd0e16a747c6d1a2d7d5d691a4f) Changed to bool
  - [`73df168`](https://github.com/maicol07/flarum-sso-php-plugin/commit/73df1680ff266d56f654a01d550435d19817579f) Support for more than one filter in users list
  - [`3315834`](https://github.com/maicol07/flarum-sso-php-plugin/commit/331583416243bf7245bac809c4022dd101c9bdc3) Return always a Collection
  
      BREAKING CHANGE: return type
  - [`6821785`](https://github.com/maicol07/flarum-sso-php-plugin/commit/682178521fe8b32ecff9e54b694db965ab0e8114) 🚚 Moved function `logout()` to Flarum
  - [`0a895d0`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0a895d0af08e6c4f75c9e8377883ce3f4e872c86) Better error handling
  - [`94b173f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/94b173fd37a94bbd0405a5a2bfa16be81e8ccc7f) Improved cookie saving
  - [`8842c70`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8842c706298465f3fbe17f3b9c8ab7bbada4ce29) ♿️ Improvements to hooks
  
      - fix: Hook can't be executed
    - Added 1 filter
  - [`993e70b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/993e70b93308b6f3c5387ef3378dca92268cabd6) Allow null as username
  
      For methods that don't involve user data such as `logout()`
  - [`f1964a1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f1964a1aa58be72e942d46719dc1351c5ad3c625) 🏷️ Added type property
  - [`63f7269`](https://github.com/maicol07/flarum-sso-php-plugin/commit/63f72690c6586920458272056d7b29da31b0b1bb) 💥 Changed constructor parameters format
  
      BREAKING CHANGE
  - [`806582f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/806582fb26df97a037dbdca7008c6ec0d902b40c) 🔥 Removed `setCookie()` function
  
      BREAKING CHANGE: function removed
  - [`f0d9655`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f0d9655dd9255a6a2ece97093a8eee81e4dea9df) Updated example
  
      - Added more ENV options
  - [`f4d4f8e`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f4d4f8ee39f9c3c4e1f4d5258d3de1af9eda2f8f) Updated example
  - [`83f0b4a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/83f0b4abc029055dec7aeb8a582fcf3debaa18fd) Updated example
  - [`6842ee6`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6842ee6bdc29430236c9d266e30302c962492c71) ✨ Added support for Laravel 8
  - [`5b568a8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5b568a88dcd819ecefeda74622e6b4427ea2f24c) 🚚 Renamed package
  
  ### 🔀 Pull Requests

- [`1cb4b3f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/1cb4b3f7e06d021b635fcdc96c39eef8fd308488) Merge pull request [#5](https://github.com/maicol07/flarum-sso-php-plugin/issues/5) from maicol07/renovate/configure
  
      Configure Renovate
  
  ### BREAKING CHANGE


changed option name and behaviour

return type

function removed


<a name="1.2.2"></a>
## [1.2.2](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.2.1...1.2.2)

> Released on August 27, 2020

### 🐛 Bug Fixes
- [`16f4e75`](https://github.com/maicol07/flarum-sso-php-plugin/commit/16f4e750d126454cd12f8a5aabc7c038a7dfd787) :pencil2:: Wrong version constraint
  
  
<a name="1.2.1"></a>
## [1.2.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.2...1.2.1)

> Released on August 27, 2020

### 🐛 Bug Fixes
- [`5c394c9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5c394c93d991adfa7317803ac83ae2ac3b86ed46) :bug: Missing class error
  
  ### Other changes
- [`9df0685`](https://github.com/maicol07/flarum-sso-php-plugin/commit/9df0685f54bf5903ebfd1286cd67489ddddcb9c3) **deps:** Changed api client namespace
  - [`714011b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/714011b174303cae5befc357db793d9056bb647a) **deps:** :arrow_up: Updated composer dependencies
  
      Changelogs summary:
     
      - symfony/translation-contracts updated from v2.0.1 to v2.1.3
        See changes: https://github.com/symfony/translation-contracts/compare/v2.0.1...v2.1.3
        Release notes: https://github.com/symfony/translation-contracts/releases/tag/v2.1.3
     
      - symfony/polyfill-php80 installed in version v1.18.1
        Release notes: https://github.com/symfony/polyfill-php80/releases/tag/v1.18.1
     
      - symfony/polyfill-mbstring updated from v1.15.0 to v1.18.1
        See changes: https://github.com/symfony/polyfill-mbstring/compare/v1.15.0...v1.18.1
        Release notes: https://github.com/symfony/polyfill-mbstring/releases/tag/v1.18.1
     
      - symfony/translation updated from v5.0.7 to v5.1.3
        See changes: https://github.com/symfony/translation/compare/v5.0.7...v5.1.3
        Release notes: https://github.com/symfony/translation/releases/tag/v5.1.3
     
      - nesbot/carbon updated from 2.32.2 to 2.39.0
        See changes: https://github.com/briannesbitt/Carbon/compare/2.32.2...2.39.0
        Release notes: https://github.com/briannesbitt/Carbon/releases/tag/2.39.0
     
      - doctrine/inflector updated from 1.3.1 to 1.4.3
        See changes: https://github.com/doctrine/inflector/compare/1.3.1...1.4.3
        Release notes: https://github.com/doctrine/inflector/releases/tag/1.4.3
     
      - symfony/polyfill-php72 installed in version v1.18.1
        Release notes: https://github.com/symfony/polyfill-php72/releases/tag/v1.18.1
     
      - paragonie/random_compat installed in version v9.99.99
        Release notes: https://github.com/paragonie/random_compat/releases/tag/v9.99.99
     
      - symfony/polyfill-php70 installed in version v1.18.1
        Release notes: https://github.com/symfony/polyfill-php70/releases/tag/v1.18.1
     
      - symfony/polyfill-intl-normalizer installed in version v1.18.1
        Release notes: https://github.com/symfony/polyfill-intl-normalizer/releases/tag/v1.18.1
     
      - symfony/polyfill-intl-idn installed in version v1.18.1
        Release notes: https://github.com/symfony/polyfill-intl-idn/releases/tag/v1.18.1
     
      - guzzlehttp/guzzle updated from 6.5.2 to 6.5.5
        See changes: https://github.com/guzzle/guzzle/compare/6.5.2...6.5.5
        Release notes: https://github.com/guzzle/guzzle/releases/tag/6.5.5
     
      - flagrow/flarum-api-client updated from dev-master[@c6faca2](:/c6faca2) to dev-master[@08c300c](:/08c300c)
        See changes: https://github.com/flagrow/flarum-api-client/compare/maicol07:c6faca2...flagrow:08c300c
     
      - roave/security-advisories installed in version dev-master[@89bed67](:/89bed67)
  
  ### 🔀 Pull Requests

- [`316760f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/316760fb8e7c530ff1f6a434809c6e02812fe717) Merge pull request [#4](https://github.com/maicol07/flarum-sso-php-plugin/issues/4) from Scumi/master
  
      src/Flarum.php: fixed plugin cookie not being deleted
  
  
<a name="1.2"></a>
## [1.2](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.1.1...1.2)

> Released on April 22, 2020

### ✨ Features
- [`abe07d7`](https://github.com/maicol07/flarum-sso-php-plugin/commit/abe07d77820e23cf76d02f8c164b86dcd58af885) Disable setting groups to admins
  
  ### ⚡ Performance Improvements
- [`213eb2c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/213eb2c041c4caaa479d23a6507974509e76fd5c) Optimized login times
  
  ### 🐛 Bug Fixes
- [`bd4ed25`](https://github.com/maicol07/flarum-sso-php-plugin/commit/bd4ed25d7a27cffb73c41fc9cec3d7d718a75e42) set_groups_admins and update
  
  ### 🐛 Bug Fixes
- [`abcf173`](https://github.com/maicol07/flarum-sso-php-plugin/commit/abcf173f29aa931cf3710702a50ec13af20fe778) Groups were not deleted from user
  - [`6a1a7ff`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6a1a7ffb8db039e58545c4cbd9ead4a3fb98d2b4) Removing PRO key don't deactivate PRO features
  - [`9977f16`](https://github.com/maicol07/flarum-sso-php-plugin/commit/9977f16d9426644ad68f4745d2a511699804f743) User can't login if it's not an admin
  - [`e44e552`](https://github.com/maicol07/flarum-sso-php-plugin/commit/e44e55208efd267bf349400b9cf886765fb9c634) Added missing class of previous commit
  - [`c57421a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c57421af59dd1dd04df5d728ae9358e8d0b602d1) User can't login if his id > 20
  
      * Better getUserList method. Now is public
    * Changed full parameter to filter (see API doc)
  
  ### 🎨 Code styling
- [`ca1524a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ca1524a2b91934d720e23abcf1ac888cc04702a1) Rearranged code
  
  
<a name="1.1.1"></a>
## [1.1.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.1...1.1.1)

> Released on April 20, 2020

### 🔀 Pull Requests

- [`a74be40`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a74be40e8c8d43cf67648976a2745209410823ef) Merge pull request [#1](https://github.com/maicol07/flarum-sso-php-plugin/issues/1) from maicol07/imgbot
  
      [ImgBot] Optimize images
  
  
<a name="1.1"></a>
## [1.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.0...1.1)

> Released on April 20, 2020

### ✨ Features
- [`f33e9c8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f33e9c8c006892982b2155ed2db3a38da6ca53c7) Password reset
  
      Includes general code style reformat and some  fixes for the pro login feature
  - [`afdb5d1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/afdb5d1888895f113f72645e5e848c3bab0247fd) Groups setting on signup, update user
  
      Includes a general code style refactor and some fixes for the setGroup features
  
  ### 🐛 Bug Fixes
- [`01635c3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/01635c3ec321cffd1c5453651851b53fcbbfa4b3) #FSSOE-1
  - [`8e55936`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8e55936bce798185401d14c9f70d06955ee752a9) Fixed not_authenticated error
  
  ### Other changes
- [`06353e3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/06353e3165e867867abfdce447ce711275a11f28) Silenced error on login form
  - [`bfecf7b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/bfecf7be1fb6ba16105bbfcbc926f2c48de81296) Fixed critical rename error
  - [`2167d47`](https://github.com/maicol07/flarum-sso-php-plugin/commit/2167d47947628d0af6560887e263c5ae569275d6) Slug rename
  
      Plugin slug has been renamed to sso-flarum.
    Naming conventions from now on:
    - Files: prefix-flarum-sso-suffix.ext
    - Options names, ids or function names: prefix_flarum_sso_plugin_suffix
    - Slugs, text domain and other slug-related strings: sso-flarum with eventually a prefix, suffix or extension
  
  
<a name="1.0"></a>
## 1.0

> Released on April 08, 2020

### ✨ Features
- [`30c2c61`](https://github.com/maicol07/flarum-sso-php-plugin/commit/30c2c619df9ab92628b3f4eab8cc8a72038b0c91) Addded insecure mode and groups setting
  
  ### Other changes
- [`2955fd9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/2955fd991f1b8f142bdda0d0b75098ef208f0a5e) Release 1.0
  
      - Completely new WordPress plugin!
    - Settings page
    - PRO features (read more on docs)
    - In the nearby future will be published in the WordPress Plugins Directory!
  - [`053b49b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/053b49ba2f958c1f8326611d79eef40eaff380ec) Release 1.0
  
      - BREAKING CHANGE! PHP 7+ required
    - BREAKING CHANGE! New request system: now using the great Flagrow API client
    - New Cookie management: now using the awesome Cookie library by Delight-im
    - New option: insecure mode (principally for local development, read in docs for more)
    - Added groups settings for users: you can now set a group for a user and, if doesn't exists, it will be created!
    - BREAKING CHANGE! Deleted sendRequest and get methods as no more used.
    - Code and performance improvements
    - Various fixes (see also the bug tracker)
  - [`54a0231`](https://github.com/maicol07/flarum-sso-php-plugin/commit/54a023106dab22fcece619f2b1a1c63d8589018d) New WordPress plugin
  - [`47eb6d3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/47eb6d3ad1677371ef0bf71c1295d1f443bc9c9e) Better installation details
  - [`4e67550`](https://github.com/maicol07/flarum-sso-php-plugin/commit/4e6755080dd9806cea90f63a2d5014c25dcf8fb8) Added namespace to Flarum class
  - [`08b2561`](https://github.com/maicol07/flarum-sso-php-plugin/commit/08b25617e411f689f1c03bb8a60887eddac14b67) General refactor
  
      - !!! PLUGIN NOW REQUIRES PHP 7+
    - Plugin can now be installed with composer!
    - Organized files in folders
    - !!! Removed config.php. Configuration can now be set with class parameters
    - New Cookie management
    - Removed removeCookie method
    - Improved README.md
    
    BREAKING CHANGE: See description
  
  ### BREAKING CHANGE


See description
