<?php

/* Generic, so I can dump the JSON data without confusing Flarum */
$json = dirname(__FILE__) . "/../etc/flarum.json";
$decoded = json_decode(file_get_contents($json), true);
return $decoded;
?>