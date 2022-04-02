<?php

use Flarum\Database\Migration;

const PACKAGE_PREFIX = 'datlechin-keyboard-shortcuts.';

return Migration::addSettings([
    PACKAGE_PREFIX . 'help' => 'h',
    PACKAGE_PREFIX . 'search' => 's',
    PACKAGE_PREFIX . 'newDiscussion' => 'shift+d',
    PACKAGE_PREFIX . 'notifications' => 'shift+n',
    PACKAGE_PREFIX . 'flags' => 'shift+f',
    PACKAGE_PREFIX . 'session' => 'shift+u',
    PACKAGE_PREFIX . 'login' => 'shift+l',
    PACKAGE_PREFIX . 'signup' => 'shift+s',
    PACKAGE_PREFIX . 'back' => 'backspace',
    PACKAGE_PREFIX . 'pinNav' => 'alt+p',
    PACKAGE_PREFIX . 'reply' => 'r',
    PACKAGE_PREFIX . 'follow' => 'f',
    PACKAGE_PREFIX . 'firstPost' => 'o',
    PACKAGE_PREFIX . 'lastPost' => 'l',
    PACKAGE_PREFIX . 'markAllAsRead' => 'shift+m',
    PACKAGE_PREFIX . 'refresh' => 'shift+r',
]);
