<?php

namespace ClarkWinkelmann\FirstPostApproval;

use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    new Extenders\CountPostApprovals(),
    new Extenders\UnapproveNewPosts(),
];
