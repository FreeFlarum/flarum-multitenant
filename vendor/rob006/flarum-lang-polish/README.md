# Polska paczka językowa dla [Flarum](https://flarum.org/)

[![Latest Stable Version](https://poser.pugx.org/rob006/flarum-lang-polish/v/stable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Latest Unstable Version](https://poser.pugx.org/rob006/flarum-lang-polish/v/unstable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![License](https://poser.pugx.org/rob006/flarum-lang-polish/license)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Total Downloads](https://poser.pugx.org/rob006/flarum-lang-polish/downloads)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 
[![Monthly Downloads](https://poser.pugx.org/rob006/flarum-lang-polish/d/monthly)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 
[![Daily Downloads](https://poser.pugx.org/rob006/flarum-lang-polish/d/daily)](https://packagist.org/packages/rob006/flarum-lang-polish/stats)

Paczka zawiera tłumaczenia dla Flarum (kompatybilne z wersją `0.1.0-beta.11` lub nowszą) oraz niemal wszystkich popularnych rozszerzeń. Pełna lista obsługiwanych rozszerzeń dostępna jest poniżej.


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

lub aby wymusić najnowszą wersję (zalecane przy aktualizacji do nowej wersji Flarum - sprawdź wcześniej [changelog](https://github.com/rob006-software/flarum-lang-polish/blob/master/CHANGELOG.md), czy żadne z wykorzystywanych przez Ciebie rozszerzeń nie utraciło wsparcia):

```console
composer require rob006/flarum-lang-polish
```

Jeśli lubisz życie na krawędzi, możesz korzystać z wersji niestabilnej (może zawierać niezweryfikonwane frazy zaproponowane przez społeczność):

```console
composer require "rob006/flarum-lang-polish:0.3.x-dev"
```

Po aktualizacji czyścimy cache:

```console
php flarum cache:clear
```


## Znalazłem błąd / Brakuje rozszerzenia X

Uwagi oraz błędy można zgłaszać na [GitHubie](https://github.com/rob006-software/flarum-lang-polish/issues) lub na [forum](https://discuss.flarum.org/d/18134-polish-language-pack/30). Propozycje tłumaczeń można zgłaszać bezpośrednio korzystając z [Weblate](https://weblate.rob006.net/) (wystarczy kliknąć status tłumaczenia na liście poniżej aby przejść do tłumaczenia danego rozszerzenia/komponentu).

> [Tłumaczenia można dostosowywać też na poziomie konkretnej instalacji forum](https://rob006.net/blog/jak-nadpisac-lub-dodac-brakujace-tlumaczenia-dla-flarum/). Stworzenie paczki językowej, która będzie odpowiadała każdemu, jest praktycznie niemożliwe. Zmiany specyficzne dla konkretnego forum lepiej ustawiać lokalnie - nie każda fraza jest na tyle uniwersalna aby mogła znaleźć się w ogólnej paczce językowej.


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
| [Facebook Login](https://github.com/flarum/auth-facebook) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-auth-facebook/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-auth-facebook/pl/) |
| [Flags](https://github.com/flarum/flags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-flags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-flags/pl/) |
| [GitHub Login](https://github.com/flarum/auth-github) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-auth-github/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-auth-github/pl/) |
| [Likes](https://github.com/flarum/likes) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-likes/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-likes/pl/) |
| [Lock](https://github.com/flarum/lock) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-lock/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-lock/pl/) |
| [Markdown](https://github.com/flarum/markdown) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-markdown/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-markdown/pl/) |
| [Mentions](https://github.com/flarum/mentions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-mentions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-mentions/pl/) |
| [Pusher](https://github.com/flarum/pusher) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-pusher/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-pusher/pl/) |
| [Statistics](https://github.com/flarum/statistics) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-statistics/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-statistics/pl/) |
| [Sticky](https://github.com/flarum/sticky) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-sticky/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-sticky/pl/) |
| [Subscriptions](https://github.com/flarum/subscriptions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-subscriptions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-subscriptions/pl/) |
| [Suspend](https://github.com/flarum/suspend) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-suspend/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-suspend/pl/) |
| [Tags](https://github.com/flarum/tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-tags/pl/) |
| [Twitter Login](https://github.com/flarum/auth-twitter) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarum-auth-twitter/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarum-auth-twitter/pl/) |

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
| [FoF Custom Footer](https://github.com/FriendsOfFlarum/custom-footer) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-custom-footer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-custom-footer/pl/) |
| [FoF Default Group](https://github.com/FriendsOfFlarum/default-group) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-default-group/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-default-group/pl/) |
| [FoF Discord Login](https://github.com/FriendsOfFlarum/auth-discord) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-auth-discord/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-auth-discord/pl/) |
| [FoF Discussion Language](https://github.com/FriendsOfFlarum/discussion-language) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-discussion-language/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-discussion-language/pl/) |
| [FoF Disposable Emails](https://github.com/FriendsOfFlarum/disposable-emails) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-disposable-emails/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-disposable-emails/pl/) |
| [FoF Drafts](https://github.com/FriendsOfFlarum/drafts) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-drafts/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-drafts/pl/) |
| [FoF Filter](https://github.com/FriendsOfFlarum/filter) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-filter/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-filter/pl/) |
| [FoF Follow Tags](https://github.com/FriendsOfFlarum/follow-tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-follow-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-follow-tags/pl/) |
| [FoF Formatting](https://github.com/FriendsOfFlarum/formatting) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-formatting/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-formatting/pl/) |
| [FoF Forum Statistics Widget](https://github.com/FriendsOfFlarum/forum-statistics-widget) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-forum-statistics-widget/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-forum-statistics-widget/pl/) |
| [FoF FrontPage](https://github.com/FriendsOfFlarum/frontpage) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-frontpage/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-frontpage/pl/) |
| [FoF Gamification](https://github.com/FriendsOfFlarum/gamification) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-gamification/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-gamification/pl/) |
| [FoF GeoIP](https://github.com/FriendsOfFlarum/geoip) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-geoip/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-geoip/pl/) |
| [FoF GitHub Sponsors](https://github.com/FriendsOfFlarum/github-sponsors) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-github-sponsors/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-github-sponsors/pl/) |
| [FoF GitLab Login](https://github.com/FriendsOfFlarum/auth-gitlab) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-auth-gitlab/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-auth-gitlab/pl/) |
| [FoF HTML Errors](https://github.com/FriendsOfFlarum/html-errors) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-html-errors/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-html-errors/pl/) |
| [FoF Ignore Users](https://github.com/FriendsOfFlarum/ignore-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-ignore-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-ignore-users/pl/) |
| [FoF Impersonate](https://github.com/FriendsOfFlarum/impersonate) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-impersonate/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-impersonate/pl/) |
| [FoF Linguist](https://github.com/FriendsOfFlarum/linguist) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-linguist/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-linguist/pl/) |
| [FoF Links](https://github.com/FriendsOfFlarum/links) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-links/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-links/pl/) |
| [FoF Masquerade](https://github.com/FriendsOfFlarum/masquerade) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-masquerade/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-masquerade/pl/) |
| [FoF Merge Discussions](https://github.com/FriendsOfFlarum/merge-discussions) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-merge-discussions/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-merge-discussions/pl/) |
| [FoF Moderator Notes](https://github.com/FriendsOfFlarum/moderator-notes) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-moderator-notes/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-moderator-notes/pl/) |
| [FoF Night Mode](https://github.com/FriendsOfFlarum/nightmode) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-nightmode/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-nightmode/pl/) |
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
| [FoF reCAPTCHA](https://github.com/FriendsOfFlarum/recaptcha) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fof-recaptcha/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fof-recaptcha/pl/) |

<!-- fof-extensions-list-stop -->


## Status tłumaczeń dla rozszerzeń społeczności

<!-- various-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [Advanced Pusher by Zhishiq](https://github.com/ZhiShiQ/FlarumPusher) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/zhishiq-pusher/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/zhishiq-pusher/pl/) |
| [Affiliation Links by Kilowhat](https://github.com/kilowhat/flarum-ext-affiliation-links) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kilowhat-affiliation-links/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kilowhat-affiliation-links/pl/) |
| [Author Change by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-author-change) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-author-change/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-author-change/pl/) |
| [Back To Website by Ziymed](https://github.com/ziymed/BackToWebsite) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/ziymed-backtowebsite/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/ziymed-backtowebsite/pl/) |
| [Bazaar by Extiverse](https://github.com/extiverse/bazaar) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/extiverse-bazaar/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/extiverse-bazaar/pl/) |
| [Best Answer by Wiwatsrt](https://github.com/wiwatsrt/flarum-ext-best-answer) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/wiwatsrt-best-answer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/wiwatsrt-best-answer/pl/) |
| [Bing Wallpaper by Irony](https://github.com/892768447/flarum-ext-bing-wallpaper) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/irony-bing-wallpaper/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/irony-bing-wallpaper/pl/) |
| [Canonical Url by Migratetoflarum](https://github.com/migratetoflarum/canonical) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-canonical/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-canonical/pl/) |
| [Carving Contest by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-carving-contest) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-carving-contest/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-carving-contest/pl/) |
| [Catch the fish by Clarkwinkelmann](https://github.com/clarkwinkelmann/catch-the-fish) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-catch-the-fish/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-catch-the-fish/pl/) |
| [Chevereto by Zhujia18](https://github.com/zhujia18/flarum-chevereto) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/zhujia18-chevereto/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/zhujia18-chevereto/pl/) |
| [Close by Hiqstd](https://github.com/HiQStd/flarum-ext-close) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/hiqstd-close/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/hiqstd-close/pl/) |
| [Code Insert by Irony](https://github.com/892768447/flarum-ext-code-insert) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/irony-code-insert/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/irony-code-insert/pl/) |
| [Colorful Borders by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-colorful-borders) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-colorful-borders/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-colorful-borders/pl/) |
| [Create User Modal by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-create-user-modal) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-create-user-modal/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-create-user-modal/pl/) |
| [Dashboard by Datitisev](https://github.com/datitisev/flarum-ext-dashboard) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/datitisev-dashboard/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/datitisev-dashboard/pl/) |
| [Diff by The turk](https://github.com/the-turk/flarum-diff) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-diff/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-diff/pl/) |
| [Discord Login by Giga300](https://github.com/giga300/flarum-auth-discord) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/giga300-auth-discord/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/giga300-auth-discord/pl/) |
| [Discussion views by Michaelbelgium](https://github.com/MichaelBelgium/flarum-discussion-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-discussion-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-discussion-views/pl/) |
| [Edit Notifications by The turk](https://github.com/the-turk/flarum-edit-notifications) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-edit-notifications/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-edit-notifications/pl/) |
| [Email as Display Name by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-email-as-display-name) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-email-as-display-name/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-email-as-display-name/pl/) |
| [Emoji Picker by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-emojionearea) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-emojionearea/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-emojionearea/pl/) |
| [Extended Appearance by The turk](https://github.com/the-turk/flarum-extended-appearance) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-extended-appearance/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-extended-appearance/pl/) |
| [Fajuu - Contact Button by Fajuu](https://github.com/Fajuu/ContactButton) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fajuu-contactbutton/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fajuu-contactbutton/pl/) |
| [Fajuu Icons by Fajuu](https://github.com/Fajuu/flarum-icons) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/fajuu-icons/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/fajuu-icons/pl/) |
| [Fake Data by Migratetoflarum](https://github.com/migratetoflarum/fake-data) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-fake-data/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-fake-data/pl/) |
| [FancyBox by Squeevee](https://github.com/squeevee/flarum-ext-fancybox) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/squeevee-fancybox/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/squeevee-fancybox/pl/) |
| [FancyBox by The turk](https://github.com/the-turk/flarum-ext-fancybox) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-fancybox/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-fancybox/pl/) |
| [Flagrow Ads by Flagrow](https://github.com/FriendsOfFlarum/ads) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flagrow-ads/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flagrow-ads/pl/) |
| [Flagrow Fonts by Flagrow](https://github.com/flagrow/fonts) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flagrow-fonts/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flagrow-fonts/pl/) |
| [Flarum Auth Sync by Askvortsov](https://github.com/askvortsov1/flarum-auth-sync) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-auth-sync/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-auth-sync/pl/) |
| [Flarum Categories by Askvortsov](https://github.com/askvortsov1/flarum-categories) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-categories/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-categories/pl/) |
| [Flarum Copy Links by Askvortsov](https://github.com/askvortsov1/flarum-copy-links) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-copy-links/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-copy-links/pl/) |
| [Flarum Discussion Templates by Askvortsov](https://github.com/askvortsov1/flarum-discussion-templates) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-discussion-templates/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-discussion-templates/pl/) |
| [Flarum Help Tags by Askvortsov](https://github.com/askvortsov1/flarum-help-tags) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-help-tags/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-help-tags/pl/) |
| [Flarum Moderator Warnings by Askvortsov](https://github.com/askvortsov1/flarum-moderator-warnings) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-moderator-warnings/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-moderator-warnings/pl/) |
| [Flarum Progressive Web App by Askvortsov](https://github.com/askvortsov1/flarum-pwa) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-pwa/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-pwa/pl/) |
| [Flarum SAML2 SSO by Askvortsov](https://github.com/askvortsov1/flarum-saml) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/askvortsov-saml/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/askvortsov-saml/pl/) |
| [Flarumite Post Decontaminator by Flarumite](https://github.com/flarumite/flarum-decontaminator) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarumite-decontaminator/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarumite-decontaminator/pl/) |
| [Flarumite Simple Discussion Views by Flarumite](https://github.com/flarumite/simple-discussion-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flarumite-simple-discussion-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flarumite-simple-discussion-views/pl/) |
| [Follow Users by Simonxeko](https://github.com/simonxeko/follow-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/simonxeko-follow-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/simonxeko-follow-users/pl/) |
| [GIFs by Therealsujitk](https://github.com/therealsujitk/flarum-ext-gifs) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/therealsujitk-gifs/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/therealsujitk-gifs/pl/) |
| [Google Login by Saleksin](https://github.com/saleksin/flarum-auth-google) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/saleksin-auth-google/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/saleksin-auth-google/pl/) |
| [Google Search by Irony](https://github.com/892768447/flarum-ext-google-search) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/irony-google-search/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/irony-google-search/pl/) |
| [Hide Me by Dotronglong](https://github.com/dotronglong/flarum-hide-me) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dotronglong-hide-me/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dotronglong-hide-me/pl/) |
| [Imgur Upload by Matteocontrini](https://github.com/matteocontrini/flarum-imgur-upload) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/matteocontrini-imgur-upload/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/matteocontrini-imgur-upload/pl/) |
| [Itemlist Order by Migratetoflarum](https://github.com/migratetoflarum/itemlist-order) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-itemlist-order/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-itemlist-order/pl/) |
| [Keyboard Shortcuts by Kvothe](https://github.com/oaklinq/flarum-ext-keyboard-shortcuts) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kvothe-keyboard-shortcuts/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kvothe-keyboard-shortcuts/pl/) |
| [LDAP login by Tituspijean](https://github.com/tituspijean/flarum-ext-auth-ldap) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tituspijean-auth-ldap/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tituspijean-auth-ldap/pl/) |
| [Login to See by Irony](https://github.com/892768447/flarum-ext-login2see) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/irony-login2see/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/irony-login2see/pl/) |
| [Mail Filter by Studosi](https://github.com/studosi-flarum/mail-filter) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/studosi-mail-filter/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/studosi-mail-filter/pl/) |
| [Mail.ru Login by Dem13n](https://github.com/Dem13n/auth-mailru) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-auth-mailru/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-auth-mailru/pl/) |
| [Mailing by Kilowhat](https://github.com/kilowhat/flarum-ext-mailing) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kilowhat-mailing/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kilowhat-mailing/pl/) |
| [Markdown+ by Veriael](https://github.com/Veriael/markdown) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/veriael-markdown/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/veriael-markdown/pl/) |
| [Mason by Flagrow](https://github.com/FriendsOfFlarum/mason) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/flagrow-mason/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/flagrow-mason/pl/) |
| [MathRen by The turk](https://github.com/the-turk/flarum-mathren) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-mathren/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-mathren/pl/) |
| [Microsoft Login by Estevao simoes](https://github.com/estevao-simoes/flarum-microsoft-auth) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/estevao-simoes-microsoft-auth/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/estevao-simoes-microsoft-auth/pl/) |
| [Money by Antoinefr](https://github.com/AntoineFr/flarum-ext-money) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/antoinefr-money/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/antoinefr-money/pl/) |
| [MyBB to Flarum by Michaelbelgium](https://github.com/MichaelBelgium/mybb_to_flarum) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-mybb-to-flarum/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-mybb-to-flarum/pl/) |
| [Neon Chat by Xelson](https://github.com/Xelson/flarum-ext-chat) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/xelson-chat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/xelson-chat/pl/) |
| [NickName Changer by Dem13n](https://github.com/Dem13n/nickname-changer) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-nickname-changer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-nickname-changer/pl/) |
| [NomisCZ LinkedIn Login by Nomiscz](https://github.com/NomisCZ/flarum-ext-auth-linkedin) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nomiscz-auth-linkedin/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nomiscz-auth-linkedin/pl/) |
| [NomisCZ Steam Login by Nomiscz](https://github.com/NomisCZ/flarum-ext-auth-steam) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nomiscz-auth-steam/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nomiscz-auth-steam/pl/) |
| [NomisCZ WeChat Login by Nomiscz](https://github.com/NomisCZ/flarum-ext-auth-wechat) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nomiscz-auth-wechat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nomiscz-auth-wechat/pl/) |
| [Odnoklassniki Login by Dem13n](https://github.com/Dem13n/auth-odnoklassniki) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-auth-odnoklassniki/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-auth-odnoklassniki/pl/) |
| [Online Users by Kvothe](https://github.com/oaklinq/flarum-ext-online-users) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kvothe-online-users/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kvothe-online-users/pl/) |
| [Online by Antoinefr](https://github.com/AntoineFr/flarum-ext-online) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/antoinefr-online/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/antoinefr-online/pl/) |
| [Password Strength Indicator by The turk](https://github.com/the-turk/flarum-password-strength) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-password-strength/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-password-strength/pl/) |
| [Passwordless by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-passwordless) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-passwordless/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-passwordless/pl/) |
| [Personal Pronouns by Shriker](https://github.com/shriker/flarum-pronouns) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/shriker-pronouns/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/shriker-pronouns/pl/) |
| [Perspective by Tank](https://github.com/flarum-tank/flarum-perspective) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tank-perspective/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tank-perspective/pl/) |
| [Post Blacklist by Xmugenx](https://github.com/xmugenx/flarum-ext-post-blacklist) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/xmugenx-post-blacklist/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/xmugenx-post-blacklist/pl/) |
| [Post Notification by Tpokorra](https://github.com/tpokorra/flarum-ext-post-notification) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tpokorra-post-notification/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tpokorra-post-notification/pl/) |
| [Preview Discussion by Simonxeko](https://github.com/simonxeko/flarum-ext-preview-discussion) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/simonxeko-preview-discussion/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/simonxeko-preview-discussion/pl/) |
| [Profile Cover by Sycho](https://github.com/SychO9/flarum-profile-cover) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/sycho-profile-cover/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/sycho-profile-cover/pl/) |
| [Profile views by Michaelbelgium](https://github.com/MichaelBelgium/flarum-profile-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/michaelbelgium-profile-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/michaelbelgium-profile-views/pl/) |
| [QQ Login by Minr](https://github.com/minr/flarum-ext-auth-qq) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/minr-auth-qq/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/minr-auth-qq/pl/) |
| [Quad Theme by Dem13n](https://github.com/Dem13n/quad-theme) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-quad-theme/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-quad-theme/pl/) |
| [Queue by Zhishiq](https://github.com/ZhiShiQ/FlarumQueue) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/zhishiq-queue/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/zhishiq-queue/pl/) |
| [Quiet Edits by The turk](https://github.com/the-turk/flarum-quiet-edits) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-quiet-edits/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-quiet-edits/pl/) |
| [ReFlar Cookie Consent by Reflar](https://github.com/ReFlar/cookie-consent) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/reflar-cookie-consent/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/reflar-cookie-consent/pl/) |
| [ReFlar Doorman by Reflar](https://github.com/FriendsOfFlarum/doorman) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/reflar-doorman/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/reflar-doorman/pl/) |
| [ReFlar Level Ranks by Reflar](https://github.com/ReFlar/level-ranks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/reflar-level-ranks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/reflar-level-ranks/pl/) |
| [ReFlar Two Factor by Reflar](https://github.com/ReFlar/twofactor) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/reflar-twofactor/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/reflar-twofactor/pl/) |
| [ReFlar Webhooks by Reflar](https://github.com/ReFlar/webhooks) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/reflar-webhooks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/reflar-webhooks/pl/) |
| [Redis Connector by Zhishiq](https://github.com/ZhiShiQ/FlarumRedis) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/zhishiq-redis/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/zhishiq-redis/pl/) |
| [Reply 2 See by Kvothe](https://github.com/oaklinq/flarum-ext-reply2see) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kvothe-reply-to-see/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kvothe-reply-to-see/pl/) |
| [SEO by V17development](https://github.com/v17development/flarum-seo) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/v17development-seo/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/v17development-seo/pl/) |
| [SSO by Maicol07](https://github.com/maicol07/flarum-ext-sso) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/maicol07-sso/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/maicol07-sso/pl/) |
| [SSOwat login by Tituspijean](https://github.com/tituspijean/flarum-ext-auth-ssowat) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/tituspijean-auth-ssowat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/tituspijean-auth-ssowat/pl/) |
| [Scratchpad by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-scratchpad) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-scratchpad/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-scratchpad/pl/) |
| [See past first post by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-see-past-first-post) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-see-past-first-post/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-see-past-first-post/pl/) |
| [Show Password by Therealsujitk](https://github.com/therealsujitk/flarum-ext-show-password) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/therealsujitk-show-password/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/therealsujitk-show-password/pl/) |
| [Sign Up Button by Kvothe](https://github.com/oaklinq/flarum-signup-button) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kvothe-signup-button/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kvothe-signup-button/pl/) |
| [Silent Mailchimp by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-silent-mailchimp) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-silent-mailchimp/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-silent-mailchimp/pl/) |
| [Spoiler BBCode by Kvothe](https://github.com/oaklinq/flarum-ext-spoiler-bbcode) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/kvothe-spoiler-bbcode/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/kvothe-spoiler-bbcode/pl/) |
| [Stargazing Theme by The turk](https://github.com/the-turk/flarum-stargazing-theme) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/the-turk-stargazing-theme/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/the-turk-stargazing-theme/pl/) |
| [Status by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-status) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-status/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-status/pl/) |
| [Syndication by Amaurycarrade](https://github.com/AmauryCarrade/flarum-ext-syndication) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/amaurycarrade-syndication/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/amaurycarrade-syndication/pl/) |
| [Telegram by Dexif](https://github.com/dexif/telegram) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dexif-telegram/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dexif-telegram/pl/) |
| [UI Tab  by Itnt](https://github.com/Littlegolden/flarum-uitab) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/itnt-uitab/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/itnt-uitab/pl/) |
| [Vkontakte Login by Dem13n](https://github.com/Dem13n/auth-vkontakte) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-auth-vkontakte/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-auth-vkontakte/pl/) |
| [Vkontakte Login by Nikovonlas](https://github.com/NikoVonLas/flarum-ext-auth-vk) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nikovonlas-auth-vk/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nikovonlas-auth-vk/pl/) |
| [Web Push Notification by Nikovonlas](https://github.com/NikoVonLas/flarum-ext-web-push) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/nikovonlas-web-push/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/nikovonlas-web-push/pl/) |
| [Webhook by Irony](https://github.com/892768447/flarum-ext-webhook) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/irony-webhook/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/irony-webhook/pl/) |
| [Weibo Login by Minr](https://github.com/minr/auth-weibo) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/minr-auth-weibo/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/minr-auth-weibo/pl/) |
| [Who read by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-who-read) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/clarkwinkelmann-who-read/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/clarkwinkelmann-who-read/pl/) |
| [Yandex Login by Dem13n](https://github.com/Dem13n/auth-yandex) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/dem13n-auth-yandex/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/dem13n-auth-yandex/pl/) |
| [highlight.js by Therealsujitk](https://github.com/therealsujitk/flarum-ext-hljs) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/therealsujitk-hljs/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/therealsujitk-hljs/pl/) |
| [vBulletin Redirects by Migratetoflarum](https://github.com/migratetoflarum/vbulletin-redirects) | [![Translation status](https://weblate.rob006.net/widgets/flarum/pl/migratetoflarum-vbulletin-redirects/svg-badge.svg)](https://weblate.rob006.net/projects/flarum/migratetoflarum-vbulletin-redirects/pl/) |

<!-- various-extensions-list-stop -->


## Credits

Paczka bazuje na [rozszerzeniu stworzonym przez bepropl](https://github.com/bepropl/lang-polish). Tworzona przy udziale społeczności jako część [Kolektywu tłumaczeń Flarum](https://github.com/rob006-software/flarum-translations).

Tłumaczenie dla `moment.js` pochodzi bezpośrednio ze [źródła](https://github.com/moment/moment/blob/2.24.0/locale/pl.js).

Tłumaczenie dla `validation.yml` bazuje na [paczce językowej dla Laravela](https://github.com/caouecs/Laravel-lang/blob/4.0.2/src/pl/validation.php).
