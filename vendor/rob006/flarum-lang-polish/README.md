# Polska paczka językowa dla [Flarum](https://flarum.org/)

Paczka zawiera tłumaczenia dla Flarum (dostosowane do wersji `0.1.0-beta.8.1`) oraz następujących wtyczek:

- [BestAnswer by Wiwatsrt ](https://github.com/wiwatsrt/flarum-ext-best-answer)
- [Upload by Flagrow](https://github.com/flagrow/upload)
- [Polls by ReFlar](https://github.com/ReFlar/polls)
- [Split by Flagrow ](https://github.com/flagrow/split)
- [Linguist by Flagrow](https://flagrow.io/extensions/flagrow/linguist)
- [Discussion Views by MichaelBelgium](https://github.com/MichaelBelgium/flarum-discussion-views)


## Instalacja

Rozszerzenie instalujemy za pomocą [Composera](https://getcomposer.org/):

```console
composer require rob006/flarum-lang-polish
```

## Aktualizacja

Aktualizacje instalujemy za pomocą [Composera](https://getcomposer.org/):

```console
composer update rob006/flarum-lang-polish
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

## Credits

Paczka bazuje na [rozszerzeniu stworzonym przez bepropl](https://github.com/bepropl/lang-polish) - to on jest autorem 
większości tłumaczeń.

Tłumaczenie dla `moment.js` pochodzi bezpośrednio ze [źródła](https://github.com/moment/moment/blob/2.24.0/locale/pl.js).
