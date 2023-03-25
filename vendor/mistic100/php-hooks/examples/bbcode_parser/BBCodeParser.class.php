<?php

include '../../src/Shortcodes.php';
use \Hooks\Shortcodes;

/**
 * Simple BBCodeParser
 *
 * Supported tags: b i u s p quote code url size color font img list
 */
class BBCodeParser
{
  private $codes;
  
  function __construct()
  {
    $this->codes = new Shortcodes();
    
    $this->codes->add_shortcode(array('b','i','u','s','p'), array($this, 'do_simple_tag'));
    $this->codes->add_shortcode('quote', array($this, 'do_quote'));
    $this->codes->add_shortcode('code', array($this, 'do_code'));
    $this->codes->add_shortcode('url', array($this, 'do_url'));
    $this->codes->add_shortcode('size', array($this, 'do_size'));
    $this->codes->add_shortcode('color', array($this, 'do_color'));
    $this->codes->add_shortcode('font', array($this, 'do_font'));
    $this->codes->add_shortcode('img', array($this, 'do_image'));
    $this->codes->add_shortcode('list', array($this, 'do_list'));
  }
  
  function parse($content)
  {
    $content = str_replace("\r\n", "\n", $content);
    $content = nl2br(trim($content), false);
    return $this->codes->do_shortcode($content);
  }
 
  /**
   * Simple tags with no parameters
   */
  function do_simple_tag($args, $content, $tag)
  {
    return '<' . $tag . '>' . $content . '</' . $tag . '>';
  }
  
  /**
   * Quote tag with optional author
   */
  function do_quote($args, $content)
  {
    if (count($args[0]))
    {
      $content.= "\n <footer>" . $args[0] . '</footer>'; 
    }
    
    return '<blockquote>' . $content . '</blockquote>';
  }
  
  /**
   * URL tag with or without text
   */
  function do_url($args, $content)
  {
    if (count($args))
    {
      $url = $args[0];
    }
    else
    {
      $url = $content;
    }
    
    if (!preg_match('/^https?:\/\//i', $url))
    {
      $url = 'http://' . $url;
    }
    
    return '<a href="' . $url .'">' . $content . '</a>';
  }
  
  /**
   * Size tag
   */
  function do_size($args, $content)
  {
    if (count($args))
    {
      $size = $args[0];
      if (is_numeric($size))
      {
        $size.= 'px';
      }
      
      return '<span style="font-size:' . $size .';">' . $content . '</span>';
    }
    else
    {
      return $content;
    }
  }
  
  /**
   * Color tag
   */
  function do_color($args, $content)
  {
    if (count($args))
    {
      $color = $args[0];
      if (preg_match('/^[0-9a-f]{3}|[0-9a-f]{6}$/i', $color))
      {
        $color = '#' . $color;
      }
      
      return '<span style="color:' . $color .';">' . $content . '</span>';
    }
    else
    {
      return $content;
    }
  }
  
  /**
   * Font tag
   */
  function do_font($args, $content)
  {
    if (count($args))
    {
      $font = $args[0];
      
      return '<span style="font-family:' . $font .';">' . $content . '</span>';
    }
    else
    {
      return $content;
    }
  }
  
  /**
   * Image tag with optional size
   */
  function do_image($args, $content)
  {
    $attrs = '';
    if (count($args) and is_numeric($args[0]))
    {
      $attrs = ' style="width:' . $args[0] . 'px;"';
    }
    
    return '<img' . $attrs . ' src="' . $content . '">';
  }
  
  /**
   * List tag with optional type
   * Supports [*] as item separator
   */
  function do_list($args, $content)
  {
    $tag = array('ul', 'ul');
    if (count($args))
    {
      $tag = array('ol type="'. $args[0] .'"', 'ol');
    }
    
    if (strpos($content, '[*]') === false)
    {
      $content = trim(str_replace('<br>', '', $content));
      
      return '<' . $tag[0] . '>'
        . '<li>'
        . str_replace("\n", "</li>\n<li>", $content)
        . '</li>'
        . '</' . $tag[1] . '>';
    }
    else
    {
      $content = preg_replace('/<br>\n\s*\[\*\]\s*/', "</li>\n<li>", $content);
      $content = substr(trim($content), 6);
      
      return '<' . $tag[0] . '>'
        . $content
        . '</li>'
        . '</' . $tag[1] . '>';
    }
  }
  
  /**
   * Code tag
   */
  function do_code($args, $content)
  {
    $content = trim(str_replace("<br>\n", "\n", $content));
    $content = htmlspecialchars($content, ENT_NOQUOTES);
    
    return '<pre><code>' . $content . '</code></pre>';
  }
  
}