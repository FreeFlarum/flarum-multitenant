# Polska paczka językowa dla [Flarum](https://flarum.org/)

[![Latest Stable Version](https://img.shields.io/packagist/v/rob006/flarum-lang-polish?color=success&label=stable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Latest Unstable Version](https://img.shields.io/packagist/v/rob006/flarum-lang-polish?include_prereleases&label=unstable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![License](https://img.shields.io/packagist/l/rob006/flarum-lang-polish)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Total Downloads](https://img.shields.io/packagist/dt/rob006/flarum-lang-polish)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 
[![Monthly Downloads](https://img.shields.io/packagist/dm/rob006/flarum-lang-polish)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 

Paczka zawiera tłumaczenia dla Flarum (kompatybilne z wersją `1.0.0` lub nowszą) oraz niemal wszystkich popularnych rozszerzeń. Pełna lista obsługiwanych rozszerzeń dostępna jest poniżej.


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

Lub aby wymusić najnowszą wersję (zalecane przy aktualizacji do nowej wersji Flarum — sprawdź wcześniej [changelog](https://github.com/rob006-software/flarum-lang-polish/blob/master/CHANGELOG.md), czy żadne z wykorzystywanych przez Ciebie rozszerzeń nie utraciło wsparcia):

```console
composer require rob006/flarum-lang-polish
```

Jeśli lubisz życie na krawędzi, możesz korzystać z wersji niestabilnej (może zawierać niezweryfikowane frazy zaproponowane przez społeczność):

```console
composer require "rob006/flarum-lang-polish:0.5.x-dev"
```

Po aktualizacji czyścimy cache:

```console
php flarum cache:clear
```


## Znalazłem błąd / Brakuje rozszerzenia X

Uwagi oraz błędy można zgłaszać na [GitHubie](https://github.com/rob006-software/flarum-lang-polish/issues) lub na [forum](https://discuss.flarum.org/d/18134-polish-language-pack/30). Propozycje tłumaczeń można zgłaszać bezpośrednio korzystając z [Weblate](https://weblate.rob006.net/) (wystarczy kliknąć status tłumaczenia na liście poniżej lub na [tej stronie](https://rob006-software.github.io/flarum-translations/status/pl.html), aby przejść do tłumaczenia danego rozszerzenia/komponentu).

> [Tłumaczenia można dostosowywać też na poziomie konkretnej instalacji forum](https://rob006.net/blog/jak-nadpisac-lub-dodac-brakujace-tlumaczenia-dla-flarum/). Stworzenie paczki językowej, która będzie odpowiadała każdemu, jest praktycznie niemożliwe. Zmiany specyficzne dla konkretnego forum lepiej ustawiać lokalnie — nie każda fraza jest na tyle uniwersalna, aby mogła znaleźć się w ogólnej paczce językowej.


## Status tłumaczeń głównego silnika Flarum

| Component | Status |
| --- | --- |
| [Core](https://github.com/flarum/core) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/core/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/core/pl/) |
| Validation | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/validation/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/validation/pl/) |


## Status tłumaczeń dla oficjalnych rozszerzeń

<!-- flarum-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [`flarum/akismet`](https://github.com/flarum/akismet) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-akismet/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-akismet/pl/) |
| [`flarum/approval`](https://github.com/flarum/approval) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-approval/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-approval/pl/) |
| [`flarum/emoji`](https://github.com/flarum/emoji) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-emoji/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-emoji/pl/) |
| [`flarum/flags`](https://github.com/flarum/flags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-flags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-flags/pl/) |
| [`flarum/likes`](https://github.com/flarum/likes) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-likes/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-likes/pl/) |
| [`flarum/lock`](https://github.com/flarum/lock) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-lock/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-lock/pl/) |
| [`flarum/markdown`](https://github.com/flarum/markdown) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-markdown/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-markdown/pl/) |
| [`flarum/mentions`](https://github.com/flarum/mentions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-mentions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-mentions/pl/) |
| [`flarum/nicknames`](https://github.com/flarum/nicknames) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-nicknames/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-nicknames/pl/) |
| [`flarum/pusher`](https://github.com/flarum/pusher) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-pusher/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-pusher/pl/) |
| [`flarum/statistics`](https://github.com/flarum/statistics) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-statistics/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-statistics/pl/) |
| [`flarum/sticky`](https://github.com/flarum/sticky) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-sticky/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-sticky/pl/) |
| [`flarum/subscriptions`](https://github.com/flarum/subscriptions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-subscriptions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-subscriptions/pl/) |
| [`flarum/suspend`](https://github.com/flarum/suspend) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-suspend/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-suspend/pl/) |
| [`flarum/tags`](https://github.com/flarum/tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-tags/pl/) |

<!-- flarum-extensions-list-stop -->


## Status tłumaczeń dla rozszerzeń od Friends of Flarum

<!-- fof-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [`fof/amazon-affiliation`](https://github.com/FriendsOfFlarum/amazon-affiliation) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-amazon-affiliation/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-amazon-affiliation/pl/) |
| [`fof/analytics`](https://github.com/FriendsOfFlarum/analytics) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-analytics/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-analytics/pl/) |
| [`fof/ban-ips`](https://github.com/FriendsOfFlarum/ban-ips) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-ban-ips/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-ban-ips/pl/) |
| [`fof/best-answer`](https://github.com/FriendsOfFlarum/best-answer) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-best-answer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-best-answer/pl/) |
| [`fof/byobu`](https://github.com/FriendsOfFlarum/byobu) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-byobu/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-byobu/pl/) |
| [`fof/cookie-consent`](https://github.com/FriendsOfFlarum/cookie-consent) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-cookie-consent/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-cookie-consent/pl/) |
| [`fof/custom-footer`](https://github.com/FriendsOfFlarum/custom-footer) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-custom-footer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-custom-footer/pl/) |
| [`fof/default-group`](https://github.com/FriendsOfFlarum/default-group) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-default-group/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-default-group/pl/) |
| [`fof/discussion-language`](https://github.com/FriendsOfFlarum/discussion-language) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-discussion-language/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-discussion-language/pl/) |
| [`fof/disposable-emails`](https://github.com/FriendsOfFlarum/disposable-emails) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-disposable-emails/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-disposable-emails/pl/) |
| [`fof/doorman`](https://github.com/FriendsOfFlarum/doorman) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-doorman/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-doorman/pl/) |
| [`fof/drafts`](https://github.com/FriendsOfFlarum/drafts) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-drafts/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-drafts/pl/) |
| [`fof/filter`](https://github.com/FriendsOfFlarum/filter) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-filter/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-filter/pl/) |
| [`fof/follow-tags`](https://github.com/FriendsOfFlarum/follow-tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-follow-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-follow-tags/pl/) |
| [`fof/formatting`](https://github.com/FriendsOfFlarum/formatting) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-formatting/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-formatting/pl/) |
| [`fof/forum-statistics-widget`](https://github.com/FriendsOfFlarum/forum-statistics-widget) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-forum-statistics-widget/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-forum-statistics-widget/pl/) |
| [`fof/frontpage`](https://github.com/FriendsOfFlarum/frontpage) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-frontpage/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-frontpage/pl/) |
| [`fof/gamification`](https://github.com/FriendsOfFlarum/gamification) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-gamification/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-gamification/pl/) |
| [`fof/geoip`](https://github.com/FriendsOfFlarum/geoip) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-geoip/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-geoip/pl/) |
| [`fof/github-sponsors`](https://github.com/FriendsOfFlarum/github-sponsors) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-github-sponsors/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-github-sponsors/pl/) |
| [`fof/html-errors`](https://github.com/FriendsOfFlarum/html-errors) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-html-errors/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-html-errors/pl/) |
| [`fof/ignore-users`](https://github.com/FriendsOfFlarum/ignore-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-ignore-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-ignore-users/pl/) |
| [`fof/impersonate`](https://github.com/FriendsOfFlarum/impersonate) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-impersonate/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-impersonate/pl/) |
| [`fof/linguist`](https://github.com/FriendsOfFlarum/linguist) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-linguist/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-linguist/pl/) |
| [`fof/links`](https://github.com/FriendsOfFlarum/links) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-links/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-links/pl/) |
| [`fof/mason`](https://github.com/FriendsOfFlarum/mason) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-mason/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-mason/pl/) |
| [`fof/masquerade`](https://github.com/FriendsOfFlarum/masquerade) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-masquerade/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-masquerade/pl/) |
| [`fof/merge-discussions`](https://github.com/FriendsOfFlarum/merge-discussions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-merge-discussions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-merge-discussions/pl/) |
| [`fof/moderator-notes`](https://github.com/FriendsOfFlarum/moderator-notes) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-moderator-notes/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-moderator-notes/pl/) |
| [`fof/nightmode`](https://github.com/FriendsOfFlarum/nightmode) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-nightmode/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-nightmode/pl/) |
| [`fof/oauth`](https://github.com/FriendsOfFlarum/oauth) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-oauth/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-oauth/pl/) |
| [`fof/open-collective`](https://github.com/FriendsOfFlarum/open-collective) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-open-collective/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-open-collective/pl/) |
| [`fof/pages`](https://github.com/FriendsOfFlarum/pages) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-pages/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-pages/pl/) |
| [`fof/passport`](https://github.com/FriendsOfFlarum/passport) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-passport/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-passport/pl/) |
| [`fof/polls`](https://github.com/FriendsOfFlarum/polls) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-polls/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-polls/pl/) |
| [`fof/pretty-mail`](https://github.com/FriendsOfFlarum/pretty-mail) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-pretty-mail/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-pretty-mail/pl/) |
| [`fof/prevent-necrobumping`](https://github.com/FriendsOfFlarum/prevent-necrobumping) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-prevent-necrobumping/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-prevent-necrobumping/pl/) |
| [`fof/pwned-passwords`](https://github.com/FriendsOfFlarum/pwned-passwords) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-pwned-passwords/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-pwned-passwords/pl/) |
| [`fof/reactions`](https://github.com/FriendsOfFlarum/reactions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-reactions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-reactions/pl/) |
| [`fof/recaptcha`](https://github.com/FriendsOfFlarum/recaptcha) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-recaptcha/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-recaptcha/pl/) |
| [`fof/secure-https`](https://github.com/FriendsOfFlarum/secure-https) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-secure-https/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-secure-https/pl/) |
| [`fof/sentry`](https://github.com/FriendsOfFlarum/sentry) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-sentry/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-sentry/pl/) |
| [`fof/share-social`](https://github.com/FriendsOfFlarum/share-social) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-share-social/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-share-social/pl/) |
| [`fof/sitemap`](https://github.com/FriendsOfFlarum/sitemap) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-sitemap/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-sitemap/pl/) |
| [`fof/socialprofile`](https://github.com/FriendsOfFlarum/socialprofile) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-socialprofile/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-socialprofile/pl/) |
| [`fof/spamblock`](https://github.com/FriendsOfFlarum/spamblock) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-spamblock/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-spamblock/pl/) |
| [`fof/split`](https://github.com/FriendsOfFlarum/split) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-split/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-split/pl/) |
| [`fof/stopforumspam`](https://github.com/FriendsOfFlarum/stopforumspam) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-stopforumspam/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-stopforumspam/pl/) |
| [`fof/subscribed`](https://github.com/FriendsOfFlarum/subscribed) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-subscribed/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-subscribed/pl/) |
| [`fof/terms`](https://github.com/FriendsOfFlarum/terms) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-terms/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-terms/pl/) |
| [`fof/upload`](https://github.com/FriendsOfFlarum/upload) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-upload/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-upload/pl/) |
| [`fof/user-bio`](https://github.com/FriendsOfFlarum/user-bio) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-user-bio/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-user-bio/pl/) |
| [`fof/user-directory`](https://github.com/FriendsOfFlarum/user-directory) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-user-directory/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-user-directory/pl/) |
| [`fof/username-request`](https://github.com/FriendsOfFlarum/username-request) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-username-request/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-username-request/pl/) |
| [`fof/webhooks`](https://github.com/FriendsOfFlarum/webhooks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-webhooks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-webhooks/pl/) |

<!-- fof-extensions-list-stop -->


## Status tłumaczeń dla rozszerzeń społeczności

<!-- various-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [`acpl/my-tags`](https://github.com/android-com-pl/my-tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/acpl-my-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/acpl-my-tags/pl/) |
| [`antoinefr/flarum-ext-money`](https://github.com/AntoineFr/flarum-ext-money) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/antoinefr-money/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/antoinefr-money/pl/) |
| [`antoinefr/flarum-ext-online`](https://github.com/AntoineFr/flarum-ext-online) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/antoinefr-online/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/antoinefr-online/pl/) |
| [`askvortsov/flarum-categories`](https://github.com/askvortsov1/flarum-categories) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-categories/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-categories/pl/) |
| [`askvortsov/flarum-checklist`](https://github.com/askvortsov1/flarum-checklist) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-checklist/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-checklist/pl/) |
| [`askvortsov/flarum-discussion-templates`](https://github.com/askvortsov1/flarum-discussion-templates) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-discussion-templates/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-discussion-templates/pl/) |
| [`askvortsov/flarum-help-tags`](https://github.com/askvortsov1/flarum-help-tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-help-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-help-tags/pl/) |
| [`askvortsov/flarum-markdown-tables`](https://github.com/askvortsov1/flarum-markdown-tables) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-markdown-tables/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-markdown-tables/pl/) |
| [`askvortsov/flarum-moderator-warnings`](https://github.com/askvortsov1/flarum-moderator-warnings) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-moderator-warnings/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-moderator-warnings/pl/) |
| [`askvortsov/flarum-pwa`](https://github.com/askvortsov1/flarum-pwa) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-pwa/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-pwa/pl/) |
| [`askvortsov/flarum-rich-text`](https://github.com/askvortsov1/flarum-rich-text) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-rich-text/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-rich-text/pl/) |
| [`askvortsov/flarum-saml`](https://github.com/askvortsov1/flarum-saml) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-saml/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-saml/pl/) |
| [`clarkwinkelmann/catch-the-fish`](https://github.com/clarkwinkelmann/catch-the-fish) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-catch-the-fish/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-catch-the-fish/pl/) |
| [`clarkwinkelmann/flarum-ext-author-change`](https://github.com/clarkwinkelmann/flarum-ext-author-change) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-author-change/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-author-change/pl/) |
| [`clarkwinkelmann/flarum-ext-bookmarks`](https://github.com/clarkwinkelmann/flarum-ext-bookmarks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-bookmarks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-bookmarks/pl/) |
| [`clarkwinkelmann/flarum-ext-create-user-modal`](https://github.com/clarkwinkelmann/flarum-ext-create-user-modal) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-create-user-modal/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-create-user-modal/pl/) |
| [`clarkwinkelmann/flarum-ext-email-as-display-name`](https://github.com/clarkwinkelmann/flarum-ext-email-as-display-name) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-email-as-display-name/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-email-as-display-name/pl/) |
| [`clarkwinkelmann/flarum-ext-emojionearea`](https://github.com/clarkwinkelmann/flarum-ext-emojionearea) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-emojionearea/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-emojionearea/pl/) |
| [`clarkwinkelmann/flarum-ext-first-post-approval`](https://github.com/clarkwinkelmann/flarum-ext-first-post-approval) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-first-post-approval/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-first-post-approval/pl/) |
| [`clarkwinkelmann/flarum-ext-mailing`](https://github.com/clarkwinkelmann/flarum-ext-mailing) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-mailing/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-mailing/pl/) |
| [`clarkwinkelmann/flarum-ext-passwordless`](https://github.com/clarkwinkelmann/flarum-ext-passwordless) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-passwordless/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-passwordless/pl/) |
| [`clarkwinkelmann/flarum-ext-popular-discussion-badge`](https://github.com/clarkwinkelmann/flarum-ext-popular-discussion-badge) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-popular-discussion-badge/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-popular-discussion-badge/pl/) |
| [`clarkwinkelmann/flarum-ext-scratchpad`](https://github.com/clarkwinkelmann/flarum-ext-scratchpad) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-scratchpad/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-scratchpad/pl/) |
| [`clarkwinkelmann/flarum-ext-shadow-ban`](https://github.com/clarkwinkelmann/flarum-ext-shadow-ban) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-shadow-ban/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-shadow-ban/pl/) |
| [`clarkwinkelmann/flarum-ext-status`](https://github.com/clarkwinkelmann/flarum-ext-status) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-status/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-status/pl/) |
| [`clarkwinkelmann/flarum-ext-who-read`](https://github.com/clarkwinkelmann/flarum-ext-who-read) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-who-read/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-who-read/pl/) |
| [`dem13n/topic-starter-label`](https://github.com/Dem13n/topic-starter-label) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-topic-starter-label/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-topic-starter-label/pl/) |
| [`flarumite/simple-discussion-views`](https://github.com/flarumite/simple-discussion-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarumite-simple-discussion-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarumite-simple-discussion-views/pl/) |
| [`glowingblue/password-strength`](https://github.com/glowingblue/flarum-ext-password-strength) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/glowingblue-password-strength/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/glowingblue-password-strength/pl/) |
| [`ianm/follow-users`](https://github.com/imorland/follow-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-follow-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-follow-users/pl/) |
| [`ianm/html-head`](https://github.com/imorland/html-head) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-html-head/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-html-head/pl/) |
| [`ianm/level-ranks`](https://github.com/imorland/level-ranks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-level-ranks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-level-ranks/pl/) |
| [`ianm/syndication`](https://github.com/imorland/syndication) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-syndication/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-syndication/pl/) |
| [`ianm/synopsis`](https://github.com/imorland/synopsis) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ianm-synopsis/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ianm-synopsis/pl/) |
| [`jslirola/flarum-ext-login2seeplus`](https://github.com/jslirola/flarum-ext-login2seeplus) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/jslirola-login2seeplus/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/jslirola-login2seeplus/pl/) |
| [`justoverclock/flarum-ext-hashtag`](https://github.com/justoverclockl/flarum-ext-hashtag) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/justoverclock-hashtag/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/justoverclock-hashtag/pl/) |
| [`justoverclock/flarum-ext-welcomebox`](https://github.com/justoverclockl/flarum-ext-welcomebox) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/justoverclock-welcomebox/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/justoverclock-welcomebox/pl/) |
| [`katosdev/signature`](https://github.com/katosdev/signature) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/katosdev-signature/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/katosdev-signature/pl/) |
| [`maicol07/flarum-ext-sso`](https://github.com/maicol07/flarum-ext-sso) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/maicol07-sso/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/maicol07-sso/pl/) |
| [`malago/flarum-ads`](https://github.com/malago86/flarum-ads) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/malago-ads/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/malago-ads/pl/) |
| [`matteocontrini/flarum-imgur-upload`](https://github.com/matteocontrini/flarum-imgur-upload) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/matteocontrini-imgur-upload/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/matteocontrini-imgur-upload/pl/) |
| [`michaelbelgium/flarum-discussion-views`](https://github.com/MichaelBelgium/flarum-discussion-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-discussion-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-discussion-views/pl/) |
| [`michaelbelgium/flarum-profile-views`](https://github.com/MichaelBelgium/flarum-profile-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-profile-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-profile-views/pl/) |
| [`migratetoflarum/canonical`](https://github.com/migratetoflarum/canonical) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-canonical/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-canonical/pl/) |
| [`migratetoflarum/fake-data`](https://github.com/migratetoflarum/fake-data) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-fake-data/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-fake-data/pl/) |
| [`nearata/flarum-ext-copy-code-to-clipboard`](https://github.com/Nearata/flarum-ext-copy-code-to-clipboard) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nearata-copy-code-to-clipboard/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nearata-copy-code-to-clipboard/pl/) |
| [`nearata/flarum-ext-tags-color-generator`](https://github.com/Nearata/flarum-ext-tags-color-generator) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nearata-tags-color-generator/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nearata-tags-color-generator/pl/) |
| [`nomiscz/flarum-ext-auth-steam`](https://github.com/NomisCZ/flarum-ext-auth-steam) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nomiscz-auth-steam/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nomiscz-auth-steam/pl/) |
| [`nomiscz/flarum-ext-auth-wechat`](https://github.com/NomisCZ/flarum-ext-auth-wechat) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nomiscz-auth-wechat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nomiscz-auth-wechat/pl/) |
| [`sycho/flarum-profile-cover`](https://github.com/SychO9/flarum-profile-cover) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/sycho-profile-cover/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/sycho-profile-cover/pl/) |
| [`the-turk/flarum-diff`](https://github.com/the-turk/flarum-diff) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-diff/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-diff/pl/) |
| [`the-turk/flarum-mathren`](https://github.com/the-turk/flarum-mathren) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-mathren/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-mathren/pl/) |
| [`the-turk/flarum-quiet-edits`](https://github.com/the-turk/flarum-quiet-edits) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-quiet-edits/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-quiet-edits/pl/) |
| [`therealsujitk/flarum-ext-gifs`](https://github.com/therealsujitk/flarum-ext-gifs) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/therealsujitk-gifs/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/therealsujitk-gifs/pl/) |
| [`tituspijean/flarum-ext-auth-ldap`](https://github.com/tituspijean/flarum-ext-auth-ldap) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tituspijean-auth-ldap/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tituspijean-auth-ldap/pl/) |
| [`tpokorra/flarum-ext-post-notification`](https://github.com/tpokorra/flarum-ext-post-notification) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tpokorra-post-notification/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tpokorra-post-notification/pl/) |
| [`v17development/flarum-blog`](https://github.com/v17development/flarum-blog) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/v17development-blog/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/v17development-blog/pl/) |
| [`v17development/flarum-seo`](https://github.com/v17development/flarum-seo) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/v17development-seo/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/v17development-seo/pl/) |
| [`v17development/flarum-user-badges`](https://github.com/v17development/flarum-user-badges) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/v17development-user-badges/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/v17development-user-badges/pl/) |

<!-- various-extensions-list-stop -->


## Status tłumaczeń dla rozszerzeń premium

<!-- premium-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [`datitisev/flarum-backup`](https://extiverse.com/extension/datitisev/flarum-backup) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/datitisev-backup/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/datitisev-backup/pl/) |
| [`datitisev/flarum-maintenance`](https://extiverse.com/extension/datitisev/flarum-maintenance) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/datitisev-maintenance/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/datitisev-maintenance/pl/) |
| [`v17development/flarum-support`](https://extiverse.com/extension/v17development/flarum-support) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/v17development-support/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/v17development-support/pl/) |

<!-- premium-extensions-list-stop -->


## Credits

Paczka bazuje na [rozszerzeniu stworzonym przez bepropl](https://github.com/bepropl/lang-polish). Tworzona z udziałem społeczności jako część [Kolektywu tłumaczeń Flarum](https://github.com/rob006-software/flarum-translations).

Tłumaczenie dla Day.js pochodzi bezpośrednio ze [źródła](https://github.com/iamkun/dayjs/blob/v1.10.4/src/locale/pl.js).

Tłumaczenie dla `validation.yml` bazuje na [paczce językowej dla Laravela](https://github.com/Laravel-Lang/lang/blob/8.1.3/src/pl/validation.php).
