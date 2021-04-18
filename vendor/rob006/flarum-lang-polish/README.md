# Polska paczka językowa dla [Flarum](https://flarum.org/)

[![Latest Stable Version](https://img.shields.io/packagist/v/rob006/flarum-lang-polish?color=success&label=stable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Latest Unstable Version](https://img.shields.io/packagist/v/rob006/flarum-lang-polish?include_prereleases&label=unstable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![License](https://img.shields.io/packagist/l/rob006/flarum-lang-polish)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Total Downloads](https://img.shields.io/packagist/dt/rob006/flarum-lang-polish)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 
[![Monthly Downloads](https://img.shields.io/packagist/dm/rob006/flarum-lang-polish)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 

Paczka zawiera tłumaczenia dla Flarum (kompatybilne z wersją `0.1.0-beta.14` lub nowszą) oraz niemal wszystkich popularnych rozszerzeń. Pełna lista obsługiwanych rozszerzeń dostępna jest poniżej.


## Instalacja

Rozszerzenie instalujemy za pomocą [Composera](https://getcomposer.org/):

```console
composer require rob006/flarum-lang-polish
```

Po czym w panelu admina włączamy rozszerzenie.


## Aktualizacja

Aktualizacje instalujemy za pomocą [Composera](https://getcomposer.org/):

```console
composer update rob006/flarum-lang-polish
```

lub aby wymusić najnowszą wersję (zalecane przy aktualizacji do nowej wersji Flarum — sprawdź wcześniej [changelog](https://github.com/rob006-software/flarum-lang-polish/blob/master/CHANGELOG.md), czy żadne z wykorzystywanych przez Ciebie rozszerzeń nie utraciło wsparcia):

```console
composer require rob006/flarum-lang-polish
```

Jeśli lubisz życie na krawędzi, możesz korzystać z wersji niestabilnej (może zawierać niezweryfikowane frazy zaproponowane przez społeczność):

```console
composer require "rob006/flarum-lang-polish:0.4.x-dev"
```

Po aktualizacji czyścimy cache:

```console
php flarum cache:clear
```


## Znalazłem błąd / Brakuje rozszerzenia X

Uwagi oraz błędy można zgłaszać na [GitHubie](https://github.com/rob006-software/flarum-lang-polish/issues) lub na [forum](https://discuss.flarum.org/d/18134-polish-language-pack/30). Propozycje tłumaczeń można zgłaszać bezpośrednio korzystając z [Weblate](https://weblate.rob006.net/) (wystarczy kliknąć status tłumaczenia na liście poniżej, aby przejść do tłumaczenia danego rozszerzenia/komponentu).

> [Tłumaczenia można dostosowywać też na poziomie konkretnej instalacji forum](https://rob006.net/blog/jak-nadpisac-lub-dodac-brakujace-tlumaczenia-dla-flarum/). Stworzenie paczki językowej, która będzie odpowiadała każdemu, jest praktycznie niemożliwe. Zmiany specyficzne dla konkretnego forum lepiej ustawiać lokalnie — nie każda fraza jest na tyle uniwersalna, aby mogła znaleźć się w ogólnej paczce językowej.


## Status tłumaczeń głównego silnika Flarum

| Component | Status |
| --- | --- |
| [Core](https://github.com/flarum/core) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/core/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/core/) |
| Validation | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/validation/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/validation/) |


## Status tłumaczeń dla oficjalnych rozszerzeń

<!-- flarum-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [Akismet](https://github.com/flarum/akismet) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-akismet/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-akismet/pl/) |
| [Approval](https://github.com/flarum/approval) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-approval/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-approval/pl/) |
| [Emoji](https://github.com/flarum/emoji) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-emoji/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-emoji/pl/) |
| [Flags](https://github.com/flarum/flags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-flags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-flags/pl/) |
| [Likes](https://github.com/flarum/likes) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-likes/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-likes/pl/) |
| [Lock](https://github.com/flarum/lock) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-lock/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-lock/pl/) |
| [Markdown](https://github.com/flarum/markdown) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-markdown/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-markdown/pl/) |
| [Mentions](https://github.com/flarum/mentions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-mentions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-mentions/pl/) |
| [Nicknames](https://github.com/flarum/nicknames) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-nicknames/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-nicknames/pl/) |
| [Pusher](https://github.com/flarum/pusher) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-pusher/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-pusher/pl/) |
| [Statistics](https://github.com/flarum/statistics) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-statistics/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-statistics/pl/) |
| [Sticky](https://github.com/flarum/sticky) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-sticky/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-sticky/pl/) |
| [Subscriptions](https://github.com/flarum/subscriptions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-subscriptions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-subscriptions/pl/) |
| [Suspend](https://github.com/flarum/suspend) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-suspend/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-suspend/pl/) |
| [Tags](https://github.com/flarum/tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-tags/pl/) |

<!-- flarum-extensions-list-stop -->


## Status tłumaczeń dla rozszerzeń od Friends of Flarum

<!-- fof-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [FoF Amazon Affiliation](https://github.com/FriendsOfFlarum/amazon-affiliation) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-amazon-affiliation/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-amazon-affiliation/pl/) |
| [FoF Analytics](https://github.com/FriendsOfFlarum/analytics) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-analytics/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-analytics/pl/) |
| [FoF Ban IPs](https://github.com/FriendsOfFlarum/ban-ips) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-ban-ips/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-ban-ips/pl/) |
| [FoF Best Answer](https://github.com/FriendsOfFlarum/best-answer) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-best-answer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-best-answer/pl/) |
| [FoF Byōbu](https://github.com/FriendsOfFlarum/byobu) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-byobu/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-byobu/pl/) |
| [FoF Cookie Consent](https://github.com/FriendsOfFlarum/cookie-consent) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-cookie-consent/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-cookie-consent/pl/) |
| [FoF Custom Footer](https://github.com/FriendsOfFlarum/custom-footer) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-custom-footer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-custom-footer/pl/) |
| [FoF Default Group](https://github.com/FriendsOfFlarum/default-group) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-default-group/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-default-group/pl/) |
| [FoF Discussion Language](https://github.com/FriendsOfFlarum/discussion-language) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-discussion-language/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-discussion-language/pl/) |
| [FoF Disposable Emails](https://github.com/FriendsOfFlarum/disposable-emails) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-disposable-emails/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-disposable-emails/pl/) |
| [FoF Doorman](https://github.com/FriendsOfFlarum/doorman) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-doorman/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-doorman/pl/) |
| [FoF Drafts](https://github.com/FriendsOfFlarum/drafts) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-drafts/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-drafts/pl/) |
| [FoF Filter](https://github.com/FriendsOfFlarum/filter) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-filter/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-filter/pl/) |
| [FoF Follow Tags](https://github.com/FriendsOfFlarum/follow-tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-follow-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-follow-tags/pl/) |
| [FoF Formatting](https://github.com/FriendsOfFlarum/formatting) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-formatting/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-formatting/pl/) |
| [FoF Forum Statistics Widget](https://github.com/FriendsOfFlarum/forum-statistics-widget) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-forum-statistics-widget/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-forum-statistics-widget/pl/) |
| [FoF FrontPage](https://github.com/FriendsOfFlarum/frontpage) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-frontpage/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-frontpage/pl/) |
| [FoF Gamification](https://github.com/FriendsOfFlarum/gamification) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-gamification/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-gamification/pl/) |
| [FoF GeoIP](https://github.com/FriendsOfFlarum/geoip) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-geoip/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-geoip/pl/) |
| [FoF GitHub Sponsors](https://github.com/FriendsOfFlarum/github-sponsors) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-github-sponsors/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-github-sponsors/pl/) |
| [FoF HTML Errors](https://github.com/FriendsOfFlarum/html-errors) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-html-errors/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-html-errors/pl/) |
| [FoF Ignore Users](https://github.com/FriendsOfFlarum/ignore-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-ignore-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-ignore-users/pl/) |
| [FoF Impersonate](https://github.com/FriendsOfFlarum/impersonate) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-impersonate/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-impersonate/pl/) |
| [FoF Linguist](https://github.com/FriendsOfFlarum/linguist) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-linguist/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-linguist/pl/) |
| [FoF Links](https://github.com/FriendsOfFlarum/links) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-links/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-links/pl/) |
| [FoF Mason](https://github.com/FriendsOfFlarum/mason) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-mason/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-mason/pl/) |
| [FoF Masquerade](https://github.com/FriendsOfFlarum/masquerade) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-masquerade/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-masquerade/pl/) |
| [FoF Merge Discussions](https://github.com/FriendsOfFlarum/merge-discussions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-merge-discussions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-merge-discussions/pl/) |
| [FoF Moderator Notes](https://github.com/FriendsOfFlarum/moderator-notes) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-moderator-notes/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-moderator-notes/pl/) |
| [FoF Night Mode](https://github.com/FriendsOfFlarum/nightmode) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-nightmode/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-nightmode/pl/) |
| [FoF OAuth](https://github.com/FriendsOfFlarum/oauth) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-oauth/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-oauth/pl/) |
| [FoF Open Collective](https://github.com/FriendsOfFlarum/open-collective) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-open-collective/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-open-collective/pl/) |
| [FoF Pages](https://github.com/FriendsOfFlarum/pages) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-pages/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-pages/pl/) |
| [FoF Passport](https://github.com/FriendsOfFlarum/passport) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-passport/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-passport/pl/) |
| [FoF Polls](https://github.com/FriendsOfFlarum/polls) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-polls/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-polls/pl/) |
| [FoF Pretty Mail](https://github.com/FriendsOfFlarum/pretty-mail) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-pretty-mail/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-pretty-mail/pl/) |
| [FoF Prevent Necrobumping](https://github.com/FriendsOfFlarum/prevent-necrobumping) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-prevent-necrobumping/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-prevent-necrobumping/pl/) |
| [FoF Pwned Passwords](https://github.com/FriendsOfFlarum/pwned-passwords) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-pwned-passwords/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-pwned-passwords/pl/) |
| [FoF Reactions](https://github.com/FriendsOfFlarum/reactions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-reactions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-reactions/pl/) |
| [FoF Secure HTTPS](https://github.com/FriendsOfFlarum/secure-https) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-secure-https/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-secure-https/pl/) |
| [FoF Sentry](https://github.com/FriendsOfFlarum/sentry) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-sentry/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-sentry/pl/) |
| [FoF Share Social](https://github.com/FriendsOfFlarum/share-social) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-share-social/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-share-social/pl/) |
| [FoF Sitemap](https://github.com/FriendsOfFlarum/sitemap) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-sitemap/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-sitemap/pl/) |
| [FoF Social Profile](https://github.com/FriendsOfFlarum/socialprofile) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-socialprofile/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-socialprofile/pl/) |
| [FoF Spamblock](https://github.com/FriendsOfFlarum/spamblock) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-spamblock/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-spamblock/pl/) |
| [FoF Split](https://github.com/FriendsOfFlarum/split) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-split/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-split/pl/) |
| [FoF Stop Forum Spam](https://github.com/FriendsOfFlarum/stopforumspam) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-stopforumspam/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-stopforumspam/pl/) |
| [FoF Subscribed](https://github.com/FriendsOfFlarum/subscribed) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-subscribed/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-subscribed/pl/) |
| [FoF Terms](https://github.com/FriendsOfFlarum/terms) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-terms/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-terms/pl/) |
| [FoF URL Transliterator](https://github.com/FriendsOfFlarum/transliterator) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-transliterator/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-transliterator/pl/) |
| [FoF Upload](https://github.com/FriendsOfFlarum/upload) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-upload/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-upload/pl/) |
| [FoF User Bio](https://github.com/FriendsOfFlarum/user-bio) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-user-bio/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-user-bio/pl/) |
| [FoF User Directory](https://github.com/FriendsOfFlarum/user-directory) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-user-directory/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-user-directory/pl/) |
| [FoF Username Request](https://github.com/FriendsOfFlarum/username-request) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-username-request/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-username-request/pl/) |
| [FoF Webhooks](https://github.com/FriendsOfFlarum/webhooks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-webhooks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-webhooks/pl/) |
| [FoF reCAPTCHA](https://github.com/FriendsOfFlarum/recaptcha) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-recaptcha/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-recaptcha/pl/) |

<!-- fof-extensions-list-stop -->


## Status tłumaczeń dla rozszerzeń społeczności

<!-- various-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [Author Change by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-author-change) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-author-change/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-author-change/pl/) |
| [Blog by V17development](https://github.com/v17development/flarum-blog) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/v17development-blog/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/v17development-blog/pl/) |
| [Bookmarks by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-bookmarks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-bookmarks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-bookmarks/pl/) |
| [Canonical Url by Migratetoflarum](https://github.com/migratetoflarum/canonical) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-canonical/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-canonical/pl/) |
| [Carving Contest by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-carving-contest) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-carving-contest/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-carving-contest/pl/) |
| [Catch the fish by Clarkwinkelmann](https://github.com/clarkwinkelmann/catch-the-fish) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-catch-the-fish/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-catch-the-fish/pl/) |
| [Categories by Askvortsov](https://github.com/askvortsov1/flarum-categories) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-categories/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-categories/pl/) |
| [Copy Code To Clipboard by Nearata](https://github.com/Nearata/flarum-ext-copy-code-to-clipboard) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nearata-copy-code-to-clipboard/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nearata-copy-code-to-clipboard/pl/) |
| [Create User Modal by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-create-user-modal) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-create-user-modal/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-create-user-modal/pl/) |
| [Dashboard by Datitisev](https://github.com/datitisev/flarum-ext-dashboard) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/datitisev-dashboard/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/datitisev-dashboard/pl/) |
| [Discussion Templates by Askvortsov](https://github.com/askvortsov1/flarum-discussion-templates) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-discussion-templates/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-discussion-templates/pl/) |
| [Discussion views by Michaelbelgium](https://github.com/MichaelBelgium/flarum-discussion-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-discussion-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-discussion-views/pl/) |
| [Emoji Picker by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-emojionearea) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-emojionearea/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-emojionearea/pl/) |
| [Fake Data by Migratetoflarum](https://github.com/migratetoflarum/fake-data) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-fake-data/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-fake-data/pl/) |
| [FancyBox by Squeevee](https://github.com/squeevee/flarum-ext-fancybox) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/squeevee-fancybox/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/squeevee-fancybox/pl/) |
| [FancyBox by The turk](https://github.com/the-turk/flarum-ext-fancybox) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-fancybox/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-fancybox/pl/) |
| [First Post Approval by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-first-post-approval) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-first-post-approval/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-first-post-approval/pl/) |
| [Flagrow Ads by Andre pullinen](https://github.com/andre-pullinen/ads) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/andre-pullinen-ads/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/andre-pullinen-ads/pl/) |
| [Flarum Auth Sync by Askvortsov](https://github.com/askvortsov1/flarum-auth-sync) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-auth-sync/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-auth-sync/pl/) |
| [Flarumite Simple Discussion Views by Flarumite](https://github.com/flarumite/simple-discussion-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarumite-simple-discussion-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarumite-simple-discussion-views/pl/) |
| [Follow Users by Simonxeko](https://github.com/simonxeko/follow-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/simonxeko-follow-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/simonxeko-follow-users/pl/) |
| [GB Password Strength by Glowingblue](https://github.com/glowingblue/flarum-ext-password-strength) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/glowingblue-password-strength/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/glowingblue-password-strength/pl/) |
| [GIFs by Therealsujitk](https://github.com/therealsujitk/flarum-ext-gifs) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/therealsujitk-gifs/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/therealsujitk-gifs/pl/) |
| [Google Login by Saleksin](https://github.com/saleksin/flarum-auth-google) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/saleksin-auth-google/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/saleksin-auth-google/pl/) |
| [HTML Head Items by Ianm](https://github.com/imorland/html-head) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-html-head/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-html-head/pl/) |
| [Help Tags by Askvortsov](https://github.com/askvortsov1/flarum-help-tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-help-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-help-tags/pl/) |
| [IM Follow Users by Ianm](https://github.com/imorland/follow-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-follow-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-follow-users/pl/) |
| [Imgur Upload by Matteocontrini](https://github.com/matteocontrini/flarum-imgur-upload) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/matteocontrini-imgur-upload/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/matteocontrini-imgur-upload/pl/) |
| [Login to See by Irony](https://github.com/892768447/flarum-ext-login2see) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/irony-login2see/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/irony-login2see/pl/) |
| [Login2SeePlus by Jslirola](https://github.com/jslirola/flarum-ext-login2seeplus) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/jslirola-login2seeplus/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/jslirola-login2seeplus/pl/) |
| [Mailing by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-mailing) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-mailing/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-mailing/pl/) |
| [Moderator Warnings by Askvortsov](https://github.com/askvortsov1/flarum-moderator-warnings) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-moderator-warnings/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-moderator-warnings/pl/) |
| [Money by Antoinefr](https://github.com/AntoineFr/flarum-ext-money) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/antoinefr-money/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/antoinefr-money/pl/) |
| [MyBB to Flarum by Michaelbelgium](https://github.com/MichaelBelgium/mybb_to_flarum) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-mybb-to-flarum/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-mybb-to-flarum/pl/) |
| [Neon Chat by Xelson](https://github.com/Xelson/flarum-ext-chat) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/xelson-chat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/xelson-chat/pl/) |
| [NomisCZ Steam Login by Nomiscz](https://github.com/NomisCZ/flarum-ext-auth-steam) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nomiscz-auth-steam/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nomiscz-auth-steam/pl/) |
| [NomisCZ WeChat Login by Nomiscz](https://github.com/NomisCZ/flarum-ext-auth-wechat) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nomiscz-auth-wechat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nomiscz-auth-wechat/pl/) |
| [Oauth Google by Luuhai48](https://github.com/luuhai48/oauth-google) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/luuhai48-oauth-google/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/luuhai48-oauth-google/pl/) |
| [Oauth LinkedIn by Luuhai48](https://github.com/luuhai48/oauth-linkedin) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/luuhai48-oauth-linkedin/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/luuhai48-oauth-linkedin/pl/) |
| [Online by Antoinefr](https://github.com/AntoineFr/flarum-ext-online) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/antoinefr-online/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/antoinefr-online/pl/) |
| [Passwordless by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-passwordless) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-passwordless/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-passwordless/pl/) |
| [Perspective by Tank](https://github.com/flarum-tank/flarum-perspective) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tank-perspective/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tank-perspective/pl/) |
| [Popular Discussion by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-popular-discussion-badge) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-popular-discussion-badge/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-popular-discussion-badge/pl/) |
| [Post Notification by Tpokorra](https://github.com/tpokorra/flarum-ext-post-notification) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tpokorra-post-notification/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tpokorra-post-notification/pl/) |
| [Preview Discussion by Simonxeko](https://github.com/simonxeko/flarum-ext-preview-discussion) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/simonxeko-preview-discussion/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/simonxeko-preview-discussion/pl/) |
| [Profile Cover by Sycho](https://github.com/SychO9/flarum-profile-cover) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/sycho-profile-cover/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/sycho-profile-cover/pl/) |
| [Profile views by Michaelbelgium](https://github.com/MichaelBelgium/flarum-profile-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-profile-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-profile-views/pl/) |
| [Progressive Web App by Askvortsov](https://github.com/askvortsov1/flarum-pwa) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-pwa/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-pwa/pl/) |
| [Quad Theme by Dem13n](https://github.com/Dem13n/quad-theme) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-quad-theme/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-quad-theme/pl/) |
| [ReFlar Level Ranks by Reflar](https://github.com/ReFlar/level-ranks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/reflar-level-ranks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/reflar-level-ranks/pl/) |
| [Reply 2 See by Kvothe](https://github.com/oaklinq/flarum-ext-reply2see) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kvothe-reply-to-see/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kvothe-reply-to-see/pl/) |
| [SAML2 SSO by Askvortsov](https://github.com/askvortsov1/flarum-saml) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-saml/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-saml/pl/) |
| [SEO by V17development](https://github.com/v17development/flarum-seo) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/v17development-seo/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/v17development-seo/pl/) |
| [SSO (Single Sign On) by Maicol07](https://github.com/maicol07/flarum-ext-sso) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/maicol07-sso/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/maicol07-sso/pl/) |
| [SSOwat login by Tituspijean](https://github.com/tituspijean/flarum-ext-auth-ssowat) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tituspijean-auth-ssowat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tituspijean-auth-ssowat/pl/) |
| [Scratchpad by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-scratchpad) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-scratchpad/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-scratchpad/pl/) |
| [See past first post by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-see-past-first-post) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-see-past-first-post/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-see-past-first-post/pl/) |
| [Shout by Kyrne](https://github.com/KyrneDev/Shout-public) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kyrne-shout/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kyrne-shout/pl/) |
| [Show Password by Therealsujitk](https://github.com/therealsujitk/flarum-ext-show-password) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/therealsujitk-show-password/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/therealsujitk-show-password/pl/) |
| [Stargazing Theme by The turk](https://github.com/the-turk/flarum-stargazing-theme) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-stargazing-theme/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-stargazing-theme/pl/) |
| [Syndication by Amaurycarrade](https://github.com/AmauryCarrade/flarum-ext-syndication) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/amaurycarrade-syndication/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/amaurycarrade-syndication/pl/) |
| [Synopsis by Ianm](https://github.com/imorland/synopsis) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-synopsis/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-synopsis/pl/) |
| [Tags Color Generator by Nearata](https://github.com/Nearata/flarum-ext-tags-color-generator) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nearata-tags-color-generator/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nearata-tags-color-generator/pl/) |
| [Topic Starter Label by Dem13n](https://github.com/Dem13n/topic-starter-label) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-topic-starter-label/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-topic-starter-label/pl/) |
| [UI Tab  by Itnt](https://github.com/Littlegolden/flarum-uitab) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/itnt-uitab/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/itnt-uitab/pl/) |
| [Who read by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-who-read) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-who-read/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-who-read/pl/) |
| [highlight.js by Therealsujitk](https://github.com/therealsujitk/flarum-ext-hljs) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/therealsujitk-hljs/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/therealsujitk-hljs/pl/) |

<!-- various-extensions-list-stop -->


## Credits

Paczka bazuje na [rozszerzeniu stworzonym przez bepropl](https://github.com/bepropl/lang-polish). Tworzona z udziałem społeczności jako część [Kolektywu tłumaczeń Flarum](https://github.com/rob006-software/flarum-translations).

Tłumaczenie dla `day.js` pochodzi bezpośrednio ze [źródła](https://github.com/iamkun/dayjs/blob/v1.9.3/src/locale/pl.js).

Tłumaczenie dla `validation.yml` bazuje na [paczce językowej dla Laravela](https://github.com/caouecs/Laravel-lang/blob/4.0.2/src/pl/validation.php).
