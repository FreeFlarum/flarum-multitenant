<?php
/**
 *  This file is part of fof/filter.
 *
 *  Copyright (c) 2020 FriendsOfFlarum..
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 */

namespace FoF\Filter\Listener;

use Flarum\Settings\Event\Saving;
use Illuminate\Contracts\Events\Dispatcher;

class AddCensorChecks
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'addCensors']);
    }

    public function addCensors(Saving $event)
    {
        if (isset($event->settings['fof-filter.words']) && $badwords = explode(', ', $event->settings['fof-filter.words'])) {
            $leet_replace = [];
            $leet_replace['a'] = '(a|a\.|a\-|4|@|Á|á|À|Â|à|Â|â|Ä|ä|Ã|ã|Å|å|α|Δ|Λ|λ)';
            $leet_replace['b'] = '(b|b\.|b\-|8|\|3|ß|Β|β)';
            $leet_replace['c'] = '(c|c\.|c\-|Ç|ç|¢|€|<|\(|{|©)';
            $leet_replace['d'] = '(d|d\.|d\-|&part;|\|\)|Þ|þ|Ð|ð)';
            $leet_replace['e'] = '(e|e\.|e\-|3|€|È|è|É|é|Ê|ê|∑)';
            $leet_replace['f'] = '(f|f\.|f\-|ƒ)';
            $leet_replace['g'] = '(g|g\.|g\-|6|9)';
            $leet_replace['h'] = '(h|h\.|h\-|Η)';
            $leet_replace['i'] = '(i|i\.|i\-|!|\||\]\[|]|1|∫|Ì|Í|Î|Ï|ì|í|î|ï)';
            $leet_replace['j'] = '(j|j\.|j\-)';
            $leet_replace['k'] = '(k|k\.|k\-|Κ|κ)';
            $leet_replace['l'] = '(l|1\.|l\-|!|\||\]\[|]|£|∫|Ì|Í|Î|Ï)';
            $leet_replace['m'] = '(m|m\.|m\-)';
            $leet_replace['n'] = '(n|n\.|n\-|η|Ν|Π)';
            $leet_replace['o'] = '(o|o\.|o\-|0|Ο|ο|Φ|¤|°|ø)';
            $leet_replace['p'] = '(p|p\.|p\-|ρ|Ρ|¶|þ)';
            $leet_replace['q'] = '(q|q\.|q\-)';
            $leet_replace['r'] = '(r|r\.|r\-|®)';
            $leet_replace['s'] = '(s|s\.|s\-|5|\$|§)';
            $leet_replace['t'] = '(t|t\.|t\-|Τ|τ|7)';
            $leet_replace['u'] = '(u|u\.|u\-|υ|µ)';
            $leet_replace['v'] = '(v|v\.|v\-|υ|ν)';
            $leet_replace['w'] = '(w|w\.|w\-|ω|ψ|Ψ)';
            $leet_replace['x'] = '(x|x\.|x\-|Χ|χ)';
            $leet_replace['y'] = '(y|y\.|y\-|¥|γ|ÿ|ý|Ÿ|Ý)';
            $leet_replace['z'] = '(z|z\.|z\-|Ζ)';

            $censorChecks = [];
            for ($x = 0, $xMax = count($badwords); $x < $xMax; $x++) {
                $censorChecks[$x] = '/'.str_ireplace(array_keys($leet_replace), array_values($leet_replace), $badwords[$x]).'/i';
            }

            $event->settings['fof-filter.censors'] = json_encode($censorChecks);
        }
    }
}
