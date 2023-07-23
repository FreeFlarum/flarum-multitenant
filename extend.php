<?php

use Flarum\Extend;
use Flarum\Frontend\Document;

include 'config.php';


$io = popen('/usr/bin/du -sm /data/host/' . $GLOBALS['this_forum']['tag'] . '/public/assets/files 2>/dev/null', 'r');
$size = fgets($io, 4096);
$GLOBALS['fof_upload_size_mb'] = intval(substr($size, 0, strpos($size, "\t")));
pclose($io);


if ($GLOBALS['this_forum']['donated_amount'] >= 20 and $GLOBALS['this_forum']['is_og_donor']) {
    $GLOBALS['max_fof_upload_size'] = 1000;
} else {
    $GLOBALS['max_fof_upload_size'] = 500;
};


$extenders = [
    (new Extend\Frontend('forum'))->content(function (Document $document) {
        if ($GLOBALS['this_forum']['donated_amount'] < 7) {
            $document->foot[] = '<p style="text-align: center; padding: 5px 0; line-height: 1.4rem;">Powered by <a href="https://freeflarum.com">FreeFlarum</a>.<br/>(<a href="https://freeflarum.com/donate">remove this footer</a>)</p>';
        };
    }),

    (new Extend\Frontend('admin'))->content(function (Document $document) {
        $document->head[] = '<style>.AuditUpgrade { display: none !important; }</style>';
    })
];


if (!$GLOBALS['this_forum']['is_og_donor'] and ($GLOBALS['this_forum']['donated_amount'] < 0 || $GLOBALS['fof_upload_size_mb'] > $GLOBALS['max_fof_upload_size'])) {
    $extenders[] = (new \FoF\Upload\Extend\Adapters())->disable('local');
};


return $extenders;
