<?php

namespace Blomstra\Spam\Concerns;

use Flarum\Locale\LocaleManager;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laminas\Diactoros\Uri;
use LanguageDetection\Language;
use Blomstra\Spam\Filter;

trait Content
{
    public function containsProblematicContent(string $content): bool
    {
        return $this->containsProblematicLinks($content)
            || $this->containsAlternateLanguage($content);
    }

    public function containsProblematicLinks(string $content): bool
    {
        $domains = Filter::getAcceptableDomains();

        // First check for links.
        preg_match_all('~(?<uri>(\w+)://(?<domain>[-\w.]+))~', $content, $links);

        foreach (array_filter($links['domain']) as $link) {
            $uri = (new Uri("http://$link"))->getHost();

            // Match exact domain or subdomains.
            if (Arr::first($domains, fn ($domain) => $domain === $uri || Str::endsWith($uri, ".$domain"))) {
                continue;
            }

            return true;
        }

        return
            // phone
            preg_match('~(\+|00)[0-9 ]{9,}~', $content) ||
            // email
            preg_match('~[\S]+@[\S]+\.[\S]+~', $content);
    }

    public function containsAlternateLanguage(string $content): bool
    {
        // strip links
        $content = preg_replace('~[\S]+@[\S]+\.[\S]+~', '', $content);
        $content = preg_replace('~https?:\/\/([-\w.]+)~', '', $content);
        $content = preg_replace('~(\+|00)[0-9 ]{9,}~', '', $content);

        // Let's not do language analysis on short strings.
        if (mb_strlen($content) < 10) return false;

        /** @var LocaleManager $locales */
        $locales = resolve(LocaleManager::class);

        $locales = array_keys($locales->getLocales());

        $languageDetection = (new Language)->detect($content);

        return ! empty($languageDetection) && ! in_array((string) $languageDetection, $locales);
    }
}
