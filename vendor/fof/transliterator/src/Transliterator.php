<?php

/*
 * This file is part of fof/transliterator
 *
 * Copyright (c) 2018 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Transliterator;

use Behat\Transliterator\Transliterator as BehatTransliterator;
use Illuminate\Support\Arr;

class Transliterator
{
    public static $transliterators = [
        'behat' => null,
        'php'   => null,
        'php2'  => null,
    ];

    public static function transliterate(string $str)
    {
        $transliterator = app('flarum.settings')->get('fof-transliterator.package');

        if ($transliterator != null && Arr::has(self::$transliterators, $transliterator)) {
            $callable = self::$transliterators[$transliterator];

            if ($callable == null) {
                return self::$transliterator($str);
            } else {
                return $callable($str);
            }
        }

        return self::behat($str);
    }

    private static function behat(string $str): string
    {
        return BehatTransliterator::transliterate($str);
    }

    private static function php(string $str): string
    {
        $str = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0100-\u7fff] remove;', $str);
        $str = preg_replace('/[-\s]+/', '-', $str);

        return trim($str, '-');
    }

    private static function php2(string $str): string
    {
        $str = transliterator_transliterate('Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();', $str);
        $str = preg_replace('/[-\s]+/', '-', $str);

        return trim($str, '-');
    }
}
