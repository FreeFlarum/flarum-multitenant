<?php
$json = dirname(__FILE__) . "/../etc/flarum.json";
$decoded = json_decode(file_get_contents($json), true);

return $decoded;
?>