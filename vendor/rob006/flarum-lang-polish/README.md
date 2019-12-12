# Polska paczka językowa dla [Flarum](https://flarum.org/)

[![Latest Stable Version](https://poser.pugx.org/rob006/flarum-lang-polish/v/stable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Latest Unstable Version](https://poser.pugx.org/rob006/flarum-lang-polish/v/unstable)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![License](https://poser.pugx.org/rob006/flarum-lang-polish/license)](https://packagist.org/packages/rob006/flarum-lang-polish) 
[![Total Downloads](https://poser.pugx.org/rob006/flarum-lang-polish/downloads)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 
[![Monthly Downloads](https://poser.pugx.org/rob006/flarum-lang-polish/d/monthly)](https://packagist.org/packages/rob006/flarum-lang-polish/stats) 
[![Daily Downloads](https://poser.pugx.org/rob006/flarum-lang-polish/d/daily)](https://packagist.org/packages/rob006/flarum-lang-polish/stats)

Paczka zawiera tłumaczenia dla Flarum (kompatybilne z wersją `0.1.0-beta.8.1` lub nowszą) oraz niemal wszystkich popularnych rozszerzeń. Pełna lista obsługiwanych rozszerzeń dostępna jest poniżej (dla nieprzetłumaczonych fraz wyświetlany jest oryginalny tekst w języku angielskim). Tłumaczenia synchronizowane są automatycznie z tekstem źródłowym rozszerzeń - wszystkie zmiany w rozszerzeniach powinny być synchronizowane w ciągu kilku godzin.


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
composer require "rob006/flarum-lang-polish:0.2.x-dev"
```

Po aktualizacji czyścimy cache:

```console
php flarum cache:clear
```

## Migracja z `bepro/lang-polish`

Jeśli masz już zainstalowane rozszerzenie [`bepro/lang-polish`](https://github.com/bepropl/lang-polish) musisz:

1. W panelu admina wyłączyć rozszerzenie `bepro/lang-polish`.

2. Odinstalować rozszerzenie za pomocą Composera:

   ```console
   composer remove bepro/lang-polish
   ```
   
3. Zainstalować nowe rozszerzenie za pomocą Composera:

   ```console
   composer require rob006/flarum-lang-polish
   ```

4. Włączyć nowe rozszerzenie w panelu admina.

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
| [FoF Amazon Affiliation](https://github.com/FriendsOfFlarum/amazon-affiliation) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-amazon-affiliation/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-amazon-affiliation/pl/) |
| [FoF Ban IPs](https://github.com/FriendsOfFlarum/ban-ips) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-ban-ips/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-ban-ips/pl/) |
| [FoF Best Answer](https://github.com/FriendsOfFlarum/best-answer) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-best-answer/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-best-answer/pl/) |
| [FoF Byōbu](https://github.com/FriendsOfFlarum/byobu) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-byobu/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-byobu/pl/) |
| [FoF Custom Footer](https://github.com/FriendsOfFlarum/custom-footer) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-custom-footer/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-custom-footer/pl/) |
| [FoF Default Group](https://github.com/FriendsOfFlarum/default-group) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-default-group/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-default-group/pl/) |
| [FoF Discord Login](https://github.com/FriendsOfFlarum/auth-discord) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-auth-discord/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-auth-discord/pl/) |
| [FoF Disposable Emails](https://github.com/FriendsOfFlarum/disposable-emails) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-disposable-emails/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-disposable-emails/pl/) |
| [FoF Drafts](https://github.com/FriendsOfFlarum/drafts) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-drafts/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-drafts/pl/) |
| [FoF Follow Tags](https://github.com/FriendsOfFlarum/follow-tags) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-follow-tags/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-follow-tags/pl/) |
| [FoF Formatting](https://github.com/FriendsOfFlarum/formatting) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-formatting/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-formatting/pl/) |
| [FoF FrontPage](https://github.com/FriendsOfFlarum/frontpage) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-frontpage/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-frontpage/pl/) |
| [FoF Gamification](https://github.com/FriendsOfFlarum/gamification) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-gamification/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-gamification/pl/) |
| [FoF GeoIP](https://github.com/FriendsOfFlarum/geoip) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-geoip/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-geoip/pl/) |
| [FoF GitLab Login](https://github.com/FriendsOfFlarum/auth-gitlab) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-auth-gitlab/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-auth-gitlab/pl/) |
| [FoF Ignore Users](https://github.com/FriendsOfFlarum/ignore-users) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-ignore-users/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-ignore-users/pl/) |
| [FoF Linguist](https://github.com/FriendsOfFlarum/linguist) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-linguist/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-linguist/pl/) |
| [FoF Links](https://github.com/FriendsOfFlarum/links) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-links/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-links/pl/) |
| [FoF Masquerade](https://github.com/FriendsOfFlarum/masquerade) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-masquerade/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-masquerade/pl/) |
| [FoF Merge Discussions](https://github.com/FriendsOfFlarum/merge-discussions) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-merge-discussions/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-merge-discussions/pl/) |
| [FoF Night Mode](https://github.com/FriendsOfFlarum/nightmode) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-nightmode/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-nightmode/pl/) |
| [FoF Open Collective](https://github.com/FriendsOfFlarum/open-collective) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-open-collective/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-open-collective/pl/) |
| [FoF Pages](https://github.com/FriendsOfFlarum/pages) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-pages/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-pages/pl/) |
| [FoF Polls](https://github.com/FriendsOfFlarum/polls) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-polls/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-polls/pl/) |
| [FoF Pretty Mail](https://github.com/FriendsOfFlarum/pretty-mail) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-pretty-mail/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-pretty-mail/pl/) |
| [FoF Prevent Necrobumping](https://github.com/FriendsOfFlarum/prevent-necrobumping) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-prevent-necrobumping/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-prevent-necrobumping/pl/) |
| [FoF Reactions](https://github.com/FriendsOfFlarum/reactions) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-reactions/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-reactions/pl/) |
| [FoF Secure HTTPS](https://github.com/FriendsOfFlarum/secure-https) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-secure-https/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-secure-https/pl/) |
| [FoF Sentry](https://github.com/FriendsOfFlarum/sentry) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-sentry/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-sentry/pl/) |
| [FoF Share Social](https://github.com/FriendsOfFlarum/share-social) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-share-social/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-share-social/pl/) |
| [FoF Social Profile](https://github.com/FriendsOfFlarum/socialprofile) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-socialprofile/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-socialprofile/pl/) |
| [FoF Spamblock](https://github.com/FriendsOfFlarum/spamblock) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-spamblock/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-spamblock/pl/) |
| [FoF Split](https://github.com/FriendsOfFlarum/split) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-split/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-split/pl/) |
| [FoF Stop Forum Spam](https://github.com/FriendsOfFlarum/stopforumspam) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-stopforumspam/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-stopforumspam/pl/) |
| [FoF Subscribed](https://github.com/FriendsOfFlarum/subscribed) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-subscribed/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-subscribed/pl/) |
| [FoF Terms](https://github.com/FriendsOfFlarum/terms) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-terms/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-terms/pl/) |
| [FoF URL Transliterator](https://github.com/FriendsOfFlarum/transliterator) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-transliterator/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-transliterator/pl/) |
| [FoF User Bio](https://github.com/FriendsOfFlarum/user-bio) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-user-bio/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-user-bio/pl/) |
| [FoF User Directory](https://github.com/FriendsOfFlarum/user-directory) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-user-directory/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-user-directory/pl/) |
| [FoF Username Request](https://github.com/FriendsOfFlarum/username-request) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-username-request/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-username-request/pl/) |
| [FoF reCAPTCHA](https://github.com/FriendsOfFlarum/recaptcha) | [![Translation status](https://weblate.rob006.net/widgets/friends-of-flarum/pl/fof-recaptcha/svg-badge.svg)](https://weblate.rob006.net/projects/friends-of-flarum/fof-recaptcha/pl/) |

<!-- fof-extensions-list-stop -->


## Status tłumaczeń dla rozszerzeń społeczności

<!-- various-extensions-list-start -->

| Extension | Status |
| --- | --- |
| [Advanced Pusher by Zhishiq](https://github.com/ZhiShiQ/FlarumPusher) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/zhishiq-pusher/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/zhishiq-pusher/pl/) |
| [Affiliation Links by Kilowhat](https://github.com/kilowhat/flarum-ext-affiliation-links) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/kilowhat-affiliation-links/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/kilowhat-affiliation-links/pl/) |
| [Analytics by Flagrow](https://github.com/flagrow/analytics) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-analytics/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-analytics/pl/) |
| [Announce by Zerosonesfun](https://github.com/zerosonesfun/announce) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/zerosonesfun-announce/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/zerosonesfun-announce/pl/) |
| [Author Change by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-author-change) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/clarkwinkelmann-author-change/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/clarkwinkelmann-author-change/pl/) |
| [Back To Website by Ziymed](https://github.com/ziymed/BackToWebsite) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/ziymed-backtowebsite/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/ziymed-backtowebsite/pl/) |
| [Bazaar by Extiverse](https://github.com/extiverse/bazaar) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/extiverse-bazaar/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/extiverse-bazaar/pl/) |
| [Best Answer by Wiwatsrt](https://github.com/wiwatsrt/flarum-ext-best-answer) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/wiwatsrt-best-answer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/wiwatsrt-best-answer/pl/) |
| [Canonical Url by Migratetoflarum](https://github.com/migratetoflarum/canonical) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/migratetoflarum-canonical/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/migratetoflarum-canonical/pl/) |
| [Carving Contest by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-carving-contest) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/clarkwinkelmann-carving-contest/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/clarkwinkelmann-carving-contest/pl/) |
| [Catch the fish by Clarkwinkelmann](https://github.com/clarkwinkelmann/catch-the-fish) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/clarkwinkelmann-catch-the-fish/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/clarkwinkelmann-catch-the-fish/pl/) |
| [Close by Hiqstd](https://github.com/HiQStd/flarum-ext-close) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/hiqstd-close/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/hiqstd-close/pl/) |
| [Dashboard by Datitisev](https://github.com/datitisev/flarum-ext-dashboard) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/datitisev-dashboard/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/datitisev-dashboard/pl/) |
| [Discord Login by Giga300](https://github.com/giga300/flarum-auth-discord) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/giga300-auth-discord/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/giga300-auth-discord/pl/) |
| [Discussion views by Michaelbelgium](https://github.com/MichaelBelgium/flarum-discussion-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/michaelbelgium-discussion-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/michaelbelgium-discussion-views/pl/) |
| [Emoji Picker by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-emojionearea) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/clarkwinkelmann-emojionearea/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/clarkwinkelmann-emojionearea/pl/) |
| [Fajuu - Contact Button by Fajuu](https://github.com/Fajuu/ContactButton) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/fajuu-contactbutton/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/fajuu-contactbutton/pl/) |
| [Fajuu Icons by Fajuu](https://github.com/Fajuu/flarum-icons) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/fajuu-icons/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/fajuu-icons/pl/) |
| [Fake Data by Migratetoflarum](https://github.com/migratetoflarum/fake-data) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/migratetoflarum-fake-data/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/migratetoflarum-fake-data/pl/) |
| [FancyBox by Squeevee](https://github.com/squeevee/flarum-ext-fancybox) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/squeevee-fancybox/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/squeevee-fancybox/pl/) |
| [Flagrow Ads by Flagrow](https://github.com/FriendsOfFlarum/ads) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-ads/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-ads/pl/) |
| [Flagrow Fonts by Flagrow](https://github.com/flagrow/fonts) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-fonts/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-fonts/pl/) |
| [Flagrow HTML Errors by Flagrow](https://github.com/flagrow/html-errors) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-html-errors/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-html-errors/pl/) |
| [Flagrow Impersonate by Flagrow](https://github.com/flagrow/impersonate) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-impersonate/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-impersonate/pl/) |
| [Google Login by Saleksin](https://github.com/saleksin/flarum-auth-google) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/saleksin-auth-google/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/saleksin-auth-google/pl/) |
| [Google Search by Irony](https://github.com/892768447/flarum-ext-google-search) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/irony-google-search/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/irony-google-search/pl/) |
| [Imgur Upload by Matteocontrini](https://github.com/matteocontrini/flarum-imgur-upload) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/matteocontrini-imgur-upload/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/matteocontrini-imgur-upload/pl/) |
| [Itemlist Order by Migratetoflarum](https://github.com/migratetoflarum/itemlist-order) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/migratetoflarum-itemlist-order/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/migratetoflarum-itemlist-order/pl/) |
| [Keyboard Shortcuts by Kvothe](https://github.com/oaklinq/flarum-ext-keyboard-shortcuts) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/kvothe-keyboard-shortcuts/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/kvothe-keyboard-shortcuts/pl/) |
| [LDAP login by Tituspijean](https://github.com/tituspijean/flarum-ext-auth-ldap) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/tituspijean-auth-ldap/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/tituspijean-auth-ldap/pl/) |
| [Mail.ru Login by Dem13n](https://github.com/Dem13n/auth-mailru) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/dem13n-auth-mailru/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/dem13n-auth-mailru/pl/) |
| [Mailing by Kilowhat](https://github.com/kilowhat/flarum-ext-mailing) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/kilowhat-mailing/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/kilowhat-mailing/pl/) |
| [Markdown+ by Veriael](https://github.com/Veriael/markdown) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/veriael-markdown/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/veriael-markdown/pl/) |
| [Mason by Flagrow](https://github.com/flagrow/mason) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-mason/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-mason/pl/) |
| [Money by Antoinefr](https://github.com/AntoineFr/flarum-ext-money) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/antoinefr-money/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/antoinefr-money/pl/) |
| [MyBB to Flarum by Michaelbelgium](https://github.com/MichaelBelgium/mybb_to_flarum) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/michaelbelgium-mybb-to-flarum/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/michaelbelgium-mybb-to-flarum/pl/) |
| [NickName Changer by Dem13n](https://github.com/Dem13n/nickname-changer) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/dem13n-nickname-changer/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/dem13n-nickname-changer/pl/) |
| [NomisCZ LinkedIn Login by Nomiscz](https://github.com/NomisCZ/flarum-ext-auth-linkedin) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/nomiscz-auth-linkedin/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/nomiscz-auth-linkedin/pl/) |
| [NomisCZ Steam Login by Nomiscz](https://github.com/NomisCZ/flarum-ext-auth-steam) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/nomiscz-auth-steam/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/nomiscz-auth-steam/pl/) |
| [Notify by Manelizzard](https://github.com/manelizzard/flarum-notify) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/manelizzard-notify/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/manelizzard-notify/pl/) |
| [Odnoklassniki Login by Dem13n](https://github.com/Dem13n/auth-odnoklassniki) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/dem13n-auth-odnoklassniki/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/dem13n-auth-odnoklassniki/pl/) |
| [Online by Antoinefr](https://github.com/AntoineFr/flarum-ext-online) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/antoinefr-online/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/antoinefr-online/pl/) |
| [Passport by Flagrow](https://github.com/flagrow/passport) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-passport/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-passport/pl/) |
| [Personal Pronouns by Shriker](https://github.com/shriker/flarum-pronouns) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/shriker-pronouns/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/shriker-pronouns/pl/) |
| [Perspective by Tank](https://github.com/tankerkiller125/flarum-perspective) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/tank-perspective/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/tank-perspective/pl/) |
| [Poke by Zerosonesfun](https://github.com/zerosonesfun/flarum-ext-poke) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/zerosonesfun-poke/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/zerosonesfun-poke/pl/) |
| [Post Blacklist by Xmugenx](https://github.com/xmugenx/flarum-ext-post-blacklist) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/xmugenx-post-blacklist/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/xmugenx-post-blacklist/pl/) |
| [Post Date by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-post-date) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/clarkwinkelmann-post-date/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/clarkwinkelmann-post-date/pl/) |
| [Post Notification by Tpokorra](https://github.com/tpokorra/flarum-ext-post-notification) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/tpokorra-post-notification/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/tpokorra-post-notification/pl/) |
| [Profile Cover by Sycho](https://github.com/SychO9/flarum-profile-cover) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/sycho-profile-cover/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/sycho-profile-cover/pl/) |
| [Profile views by Michaelbelgium](https://github.com/MichaelBelgium/flarum-profile-views) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/michaelbelgium-profile-views/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/michaelbelgium-profile-views/pl/) |
| [Queue by Zhishiq](https://github.com/ZhiShiQ/FlarumQueue) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/zhishiq-queue/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/zhishiq-queue/pl/) |
| [ReFlar Cookie Consent by Reflar](https://github.com/ReFlar/cookie-consent) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/reflar-cookie-consent/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/reflar-cookie-consent/pl/) |
| [ReFlar Doorman by Reflar](https://github.com/ReFlar/doorman) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/reflar-doorman/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/reflar-doorman/pl/) |
| [ReFlar Level Ranks by Reflar](https://github.com/ReFlar/level-ranks) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/reflar-level-ranks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/reflar-level-ranks/pl/) |
| [ReFlar Pwned Passwords by Reflar](https://github.com/ReFlar/pwned-passwords) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/reflar-pwned-passwords/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/reflar-pwned-passwords/pl/) |
| [ReFlar Two Factor by Reflar](https://github.com/ReFlar/twofactor) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/reflar-twofactor/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/reflar-twofactor/pl/) |
| [ReFlar Webhooks by Reflar](https://github.com/ReFlar/webhooks) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/reflar-webhooks/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/reflar-webhooks/pl/) |
| [Redis Connector by Zhishiq](https://github.com/ZhiShiQ/FlarumRedis) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/zhishiq-redis/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/zhishiq-redis/pl/) |
| [Reply 2 See by Kvothe](https://github.com/oaklinq/flarum-ext-reply2see) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/kvothe-reply-to-see/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/kvothe-reply-to-see/pl/) |
| [SEO by V17development](https://github.com/v17development/flarum-seo) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/v17development-seo/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/v17development-seo/pl/) |
| [SSO by Maicol07](https://github.com/maicol07/flarum-ext-sso) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/maicol07-sso/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/maicol07-sso/pl/) |
| [SSOwat login by Tituspijean](https://github.com/tituspijean/flarum-ext-auth-ssowat) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/tituspijean-auth-ssowat/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/tituspijean-auth-ssowat/pl/) |
| [Sign Up Button by Kvothe](https://github.com/oaklinq/flarum-signup-button) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/kvothe-signup-button/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/kvothe-signup-button/pl/) |
| [Spoiler BBCode by Kvothe](https://github.com/oaklinq/flarum-ext-spoiler-bbcode) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/kvothe-spoiler-bbcode/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/kvothe-spoiler-bbcode/pl/) |
| [Status by Clarkwinkelmann](https://github.com/clarkwinkelmann/flarum-ext-status) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/clarkwinkelmann-status/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/clarkwinkelmann-status/pl/) |
| [Syndication by Amaurycarrade](https://github.com/AmauryCarrade/flarum-ext-syndication) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/amaurycarrade-syndication/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/amaurycarrade-syndication/pl/) |
| [Telegram by Dexif](https://github.com/dexif/telegram) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/dexif-telegram/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/dexif-telegram/pl/) |
| [Upload by Flagrow](https://github.com/flagrow/upload) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/flagrow-upload/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/flagrow-upload/pl/) |
| [Vkontakte Login by Dem13n](https://github.com/Dem13n/auth-vkontakte) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/dem13n-auth-vkontakte/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/dem13n-auth-vkontakte/pl/) |
| [Vkontakte Login by Nikovonlas](https://github.com/NikoVonLas/flarum-ext-auth-vk) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/nikovonlas-auth-vk/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/nikovonlas-auth-vk/pl/) |
| [Web Push Notification by Nikovonlas](https://github.com/NikoVonLas/flarum-ext-web-push) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/nikovonlas-web-push/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/nikovonlas-web-push/pl/) |
| [Yandex Login by Dem13n](https://github.com/Dem13n/auth-yandex) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/dem13n-auth-yandex/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/dem13n-auth-yandex/pl/) |
| [vBulletin Redirects by Migratetoflarum](https://github.com/migratetoflarum/vbulletin-redirects) | [![Translation status](https://weblate.rob006.net/widgets/flarum-extensions/pl/migratetoflarum-vbulletin-redirects/svg-badge.svg)](https://weblate.rob006.net/projects/flarum-extensions/migratetoflarum-vbulletin-redirects/pl/) |

<!-- various-extensions-list-stop -->


## Credits

Paczka bazuje na [rozszerzeniu stworzonym przez bepropl](https://github.com/bepropl/lang-polish). Tworzona przy udziale społeczności jako część [Kolektywu tłumaczeń Flarum](https://github.com/rob006-software/flarum-translations).

Tłumaczenie dla `moment.js` pochodzi bezpośrednio ze [źródła](https://github.com/moment/moment/blob/2.24.0/locale/pl.js).

Tłumaczenie dla `validation.yml` pochodzi z [paczki językowej dla Laravela](https://github.com/caouecs/Laravel-lang/blob/4.0.2/src/pl/validation.php).
