<?php

include '../../src/Shortcodes.php';
use \Hooks\Shortcodes;

function parse_youtube($attrs, $content, $tag, $attrs_parser)
{
  $a = $attrs_parser(array(
    'autoplay',
    'no-controls',
    'list' => null,
    'id' => null,
    'width' => array(FILTER_VALIDATE_INT, 640),
    'height' => array(FILTER_VALIDATE_INT, 390),
    'color' => array('/^(red|white)$/', 'red'),
    'theme' => array('/^(dark|light)$/', 'dark'),
    'start' => array(FILTER_VALIDATE_INT, 0),
  ), $attrs);
  
  if (!$a['id'] && !$a['list'])
  {
    return 'Missing id or list parameter';
  }
  
  $h = '<iframe type="text/html" frameborder=0 width='. $a['width'] .' height='. $a['height'] .' src="http://www.youtube.com/embed';
  if ($a['id']) $h.= '/'. $a['id'];
  $h.= '?color='. $a['color'] .'&theme='. $a['theme'] .'&autoplay='. intval($a['autoplay']) .'&controls='. intval(!$a['no-controls']);
  if ($a['list']) $h.= '&listType=playlist&list='. $a['list'];
  else $h.= '&start=' . $a['start'];
  $h.= '"/>';
  
  return $h;
}

$codes = new Shortcodes();
$codes->add_shortcode('youtube', 'parse_youtube');

$default_content = '[youtube id=lb-oHOu3igg color=white theme=light]';
$content = isset($_POST['content']) ? $_POST['content'] : $default_content;
$parsed_content = $codes->do_shortcode($content);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>PHP Shortcodes</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>

<body class="container">

<div class="page-header">
  <h1>PHP Shortcodes <small>Youtube tag example</small></h1>
</div>

<div class="col-md-6">
  <form method="POST">
    <p>Supported attributes: id, list, autoplay, no-controls, width, height, color, theme, start.</p>
    <textarea style="width:100%;height:200px" name="content"><?php echo $content; ?></textarea>
    <input type="submit" value="Parse" class="btn btn-primary">
  </form>
</div>

<div class="col-md-6">
  <?php echo $parsed_content; ?>
</div>

</body>
</html>