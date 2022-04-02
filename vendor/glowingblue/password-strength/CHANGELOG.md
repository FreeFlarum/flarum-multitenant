### `1.0.2`

-   Placeholders weren't fully centered thanks to `padding-right: 50px;` value that comes with the
    eye icon. Fixed this by adding `padding-left: 50px;`. I also removed the unnecessary
    `!important` property on paddings so RTL readers can relocate the icon to the left and use right
    aligned placeholder.

**Known issues:**

Password visibility toggle conflicts with the `therealsujitk/flarum-ext-show-password`

### 1.0.1

-   **Remove** custom placeholders.

### 1.0.0

I practically rewritten and redesigned the whole thing.

-   Load `zxcvbn` only when it is necessary (via CDN).
-   Now we have three labels as 'Weak', 'Could be stronger' and 'Strong' instead of five. Also you
    can't disable these labels from the settings modal anymore.
    -   Strength score is 0/4 or 1/4 -> Weak
    -   Strength score is 2/4 or 3/4 -> Could be stronger
    -   Strength score is 4/4 -> Strong
-   **Add** password visibility toggle option.
    -   Okay I know we already have
        [Show Password](https://discuss.flarum.org/d/22727-show-password) for this. But I just
        wanted to do something that'll look good together with the strength indicator.
-   **Remove** "Change input's background color with password strength score" option.
-   Run prettier for all JS files.

### 0.1.3

-   **Add** Indonesian translations.
-   **Update** version constraints for Flarum 0.1.0-beta.13.

### 0.1.2

-   **Update** version constraints for Flarum 0.1.0-beta.12.

### 0.1.1

-   **Add** Chinese & Japanese translations.

### 0.1.0

Initial release.
