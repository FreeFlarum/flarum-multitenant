<?php

include 'BBCodeParser.class.php';
$bbcode = new BBCodeParser();

$default_content = 
'[p][size=18][b]Lorem ipsum[/b][/size] dolor sit amet, [i]consectetur adipiscing[/i] [u]elit[/u]. Maecenas rhoncus, [color=red]quam id[/color] aliquet volutpat, sapien mauris posuere orci, ut accumsan augue enim quis [s]libero.[/p]

[quote=Marcus]Fusce nec ex neque. Nunc mattis ut turpis id consectetur. [font=Time]Ut vehicula blandit[/font] justo quis posuere. Etiam scelerisque turpis at massa facilisis, ac molestie tortor ornare.[/quote]

[list]
  Vestibulum ultrices elit nec libero mattis, ac placerat leo laoreet.
  Proin sed ex mollis risus pulvinar interdum nec eu leo.
  Duis iaculis ligula eu ante porta hendrerit.
[/list]

[list=A]
  [*] Nunc mattis ut turpis id consectetur.
    Etiam scelerisque turpis at massa facilisis.
  [*] Fusce nec ex neque.
[/list]

[code]
#include <iostream>
 
int main() {
    using std::cout;
    cout << "Hello, new world !"
         << std::endl;
}
[/code]

[url=http://www.w3.org]Nam ullamcorper[/url]
[url]www.w3.org[/url]

[img=300]http://www.w3.org/html/logo/img/html5-display.png[/img]';

$content = isset($_POST['content']) ? $_POST['content'] : $default_content;
$parsed_content = $bbcode->parse($content);

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
  <h1>PHP Shortcodes <small>BBCode parser</small></h1>
</div>

<div class="col-md-6">
  <form method="POST">
    <textarea style="width:100%;height:600px" name="content"><?php echo $content; ?></textarea>
    <input type="submit" value="Parse" class="btn btn-primary">
  </form>
</div>

<div class="col-md-6">
  <?php echo $parsed_content; ?>
</div>

</body>
</html>