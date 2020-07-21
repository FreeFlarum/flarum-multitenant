<?php

use Flarum\Database\Migration;

return Migration::addSettings([
    'fof-forum-statistics-widget.ignore_private_discussions' => true,
    'fof-forum-statistics-widget.widget_order' => 0
]);
