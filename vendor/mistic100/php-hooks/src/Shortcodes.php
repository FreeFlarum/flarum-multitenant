<?php
/**
 * PHP Shortcodes Class
 * From PHP Hooks by Lars Moelleken
 *
 * The PHP Shortcodes Class is a fork of the WordPress shortcodes system rolled in to a class to be ported
 * into any php based system. It interfaces with PHP Hooks for shortcodes filtering.
 *
 * This class is heavily based on the WordPress plugin API and most (if not all) of the code comes from there.
 *
 *
 * @version 0.3
 * @copyright 2011 - 2014
 * @author Lars Moelleken <lars@moelleken.org>
 * @link https://github.com/voku/PHP-Hooks
 * @author Damien "Mistic" Sorel <contact@git.strangeplanet.fr>
 * @link http://www.strangeplanet.fr
 *
 * @license GNU General Public LIcense v3.0 - license.txt
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Hooks;

/**
 * Shortcodes
 */
class Shortcodes
{
  /**
   * Container for storing shortcode tags and their hook to call for the shortcode
   *
   * @since 0.1
   * @var array
   */
  public $shortcode_tags = array();

  /**
   * List a flags useable for validation
   *
   * @since 0.3
   * @var array
   */
  static $validation_flags = array(
    FILTER_VALIDATE_BOOLEAN, FILTER_VALIDATE_EMAIL, FILTER_VALIDATE_FLOAT,
    FILTER_VALIDATE_INT, FILTER_VALIDATE_IP, FILTER_VALIDATE_URL
    );


  /**
   * __construct class constructor
   *
   * @access public
   * @since 0.1
   */
  public function __construct()
  {
    $this->shortcode_tags = array();
  }


  /**
   * Add hook for one or multiple shortcode tags. All provided tags will be parsed with the same function.
   *
   * There can only be one hook for each shortcode. Which means that if another
   * plugin has a similar shortcode, it will override yours or yours will override
   * theirs depending on which order the plugins are included and/or ran.
   *
   * The $func parameters are:
   *    - array $attrs hashmap of attributes
   *    - string|null $content content of the shortcode if any
   *    - string $tag shortcode name
   *    - Callable $atts_parser reference to Shortcodes::shortcode_atts method
   *
   * @since 0.1
   * @access public
   *
   * @param string|string[] $tags         Shortcode tag(s) to be searched in content.
   * @param callable        $function     Hook to run when shortcode is found.
   * @param string          $include_path Optional. File to include before executing the callback.
   */
  public function add_shortcode($tags, $function, $include_path = null)
  {
    if (!is_array($tags))
    {
      $tags = array($tags);
    }

    foreach ($tags as $tag)
    {
      $this->shortcode_tags[$tag] = array(
        'function' => $function,
        'include_path' => is_string($include_path) ? $include_path : null,
        );
    }
  }

  /**
   * Removes hook for shortcode.
   *
   * @since 0.1
   * @access public
   *
   * @param string $tag shortcode tag to remove hook for.
   */
  public function remove_shortcode($tag)
  {
    unset($this->shortcode_tags[$tag]);
  }

  /**
   * Clear all shortcodes.
   *
   * @since 0.1
   * @access public
   */
  public function remove_all_shortcodes()
  {
    $this->shortcode_tags = array();
  }

  /**
   * Whether a registered shortcode exists named $tag
   *
   * @since 0.1
   * @access public
   *
   * @param string $tag Shortcode tag to be searched in known codes.
   * @return boolean
   */
  public function shortcode_exists($tag)
  {
    return array_key_exists($tag, $this->shortcode_tags);
  }

  /**
   * Whether the passed content contains the specified shortcode.
   *
   * If the second parameter is ommited, will return true whether the content
   * has any known shortcode.
   *
   * @since 0.1
   * @access public
   *
   * @param string $content Content to search for shortcodes.
   * @param string $tag     Optional. Shortcode tag to be searched in content.
   * @return bool
   */
  public function has_shortcode($content, $tag = null)
  {
    if (false === strpos($content, '['))
    {
      return false;
    }

    if ($tag !== null && !$this->shortcode_exists($tag))
    {
      return false;
    }

    preg_match_all('/' . $this->__get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER);
    if (empty($matches))
    {
      return false;
    }

    if ($tag === null)
    {
      return true;
    }

    foreach ($matches as $shortcode)
    {
      if ($tag === $shortcode[2])
      {
        return true;
      }
      elseif (!empty($shortcode[5]) && $this->has_shortcode($shortcode[5], $tag))
      {
        return true;
      }
    }
    return false;
  }

  /**
   * Search content for shortcodes and filter shortcodes through their hooks.
   *
   * If there are no shortcode tags defined, then the content will be returned
   * without any filtering. This might cause issues when plugins are disabled but
   * the shortcode will still show up in the post or content.
   *
   * @since 0.1
   * @access public
   *
   * @param string          $content Content to search for shortcodes.
   * @param string|string[] $tag     Optional. Shortcodes to parse.
   * @return string Content with shortcodes filtered out.
   */
  public function do_shortcode($content, $tag = null)
  {
    if (empty($this->shortcode_tags))
    {
      return $content;
    }

    $pattern = $this->__get_shortcode_regex($tag);
    $loop = 0;

    do {
      $content = preg_replace_callback(
        "/$pattern/s",
        array($this, '__do_shortcode_tag'),
        $content
      );

      $loop++;
    }
    while ($loop<10 && $this->has_shortcode($content));

    return $content;
  }

  /**
   * Retrieve the shortcode regular expression for searching.
   *
   * The regular expression combines the shortcode tags in the regular expression
   * in a regex class.
   *
   * The regular expression contains 6 different sub matches to help with parsing.
   *
   * 1 - An extra [ to allow for escaping shortcodes with double [[]]
   * 2 - The shortcode name
   * 3 - The shortcode argument list
   * 4 - The self closing /
   * 5 - The content of a shortcode when it wraps some content.
   * 6 - An extra ] to allow for escaping shortcodes with double [[]]
   *
   * @since 0.1
   * @access private
   *
   * @param string|string[] $tagnames Optional. Shortcodes to parse.
   * @return string The shortcode search regular expression.
   */
  private function __get_shortcode_regex($tagnames = null)
  {
    if ($tagnames === null)
    {
      $tagnames = array_keys($this->shortcode_tags);
    }
    else if (!is_array($tagnames))
    {
      $tagnames = array($tagnames);
    }

    $tagregexp = join('|', array_map('preg_quote', $tagnames));

    // WARNING! Do not change this regex without changing __do_shortcode_tag() and __strip_shortcode_tag()
    return
        '\\[' // Opening bracket
        . '(\\[?)' // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
        . "($tagregexp)" // 2: Shortcode name
        . '(?![\\w-])' // Not followed by word character or hyphen
        . '(' // 3: Unroll the loop: Inside the opening shortcode tag
        . '[^\\]\\/]*' // Not a closing bracket or forward slash
        . '(?:'
        . '\\/(?!\\])' // A forward slash not followed by a closing bracket
        . '[^\\]\\/]*' // Not a closing bracket or forward slash
        . ')*?'
        . ')'
        . '(?:'
        . '(\\/)' // 4: Self closing tag ...
        . '\\]' // ... and closing bracket
        . '|'
        . '\\]' // Closing bracket
        . '(?:'
        . '(' // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
        . '[^\\[]*+' // Not an opening bracket
        . '(?:'
        . '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
        . '[^\\[]*+' // Not an opening bracket
        . ')*+'
        . ')'
        . '\\[\\/\\2\\]' // Closing shortcode tag
        . ')?'
        . ')'
        . '(\\]?)'; // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
  }

  /**
   * Regular Expression callable for do_shortcode() for calling shortcode hook.
   * @see    get_shortcode_regex for details of the match array contents.
   *
   * @since  0.1
   * @access private
   *
   * @param array $m Regular expression match array.
   * @return string
   */
  private function __do_shortcode_tag($m)
  {
    // allow [[foo]] syntax for escaping a tag
    if ($m[1] == '[' && $m[6] == ']')
    {
      return substr($m[0], 1, -1);
    }

    $tag = $m[2];
    $the_ = $this->shortcode_tags[$tag];
    $attrs = $this->__shortcode_parse_atts($m[3]);
    $parser = array($this, 'shortcode_atts');

    if (!is_null($the_['include_path']))
    {
      include_once($the_['include_path']);
    }

    return $m[1] . call_user_func($the_['function'], $attrs, $m[5], $tag, $parser) . $m[6];
  }

  /**
   * Retrieve all attributes from the shortcodes tag.
   *
   * The attributes list has the attribute name as the key and the value of the
   * attribute as the value in the key/value pair. This allows for easier
   * retrieval of the attributes, since all attributes have to be known.
   *
   * @since 0.1
   * @access private
   *
   * @param string $text Text block of all attributes.
   * @return array List of attributes and their value.
   */
  private function __shortcode_parse_atts($text)
  {
    $atts = array();

    $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);

    $pattern = 
      // named attr double quoted
      '(\w+)' // 1: attr name
      . '\s*=\s*"' // equal sign and double quote
      . '([^"]*)' // 2: attr value
      . '"(?:\s|$)' // double and white space or end of string
      . '|'
      // named attr single quoted
      . '(\w+)' // 3: attr name
      . '\s*=\s*\'' // equal sign and single quote
      . '([^\']*)' // 4: attr value
      . '\'(?:\s|$)' // single quote and white space or end of string
      . '|'
      // named attr with no quote
      . '(\w+)' // 5: attr name
      . '\s*=\s*' // equal sign
      . '([^\s\'"]+)' // 6: attr value
      . '(?:\s|$)' // white space or end of string
      . '|'
      // unnamed attr double quoted
      . '=?"' // optional equals sign and double quote
      . '([^"]*)' // 7: attr value
      . '"(?:\s|$)' // double quote and white space or end of string
      . '|'
      // unnamed attr single quoted
      . '=?\'' // optional equals sign and single quote
      . '([^\']*)' // 8: attr value
      . '\'(?:\s|$)' // single quote and white space or end of string
      . '|'
      // unnamed attr with no quote
      . '=?' // optional equals sign
      . '(\S+)' // 9: attr value
      . '(?:\s|$)'; // white space or end of string

    if (preg_match_all("/$pattern/", $text, $match, PREG_SET_ORDER))
    {
      foreach ($match as $m)
      {
        if (!empty($m[1]))
        {
          $atts[strtolower($m[1])] = stripcslashes($m[2]);
        }
        elseif (!empty($m[3]))
        {
          $atts[strtolower($m[3])] = stripcslashes($m[4]);
        }
        elseif (!empty($m[5]))
        {
          $atts[strtolower($m[5])] = stripcslashes($m[6]);
        }
        elseif (isset($m[7]) and strlen($m[7]))
        {
          $atts[] = stripcslashes($m[7]);
        }
        elseif (isset($m[8]) and strlen($m[8]))
        {
          $atts[] = stripcslashes($m[8]);
        }
        elseif (isset($m[9]))
        {
          $atts[] = stripcslashes($m[9]);
        }
      }
    }
    else
    {
      $atts = array();
    }

    return $atts;
  }

  /**
   * Combine user attributes with known attributes and fill in defaults when needed.
   *
   * The pairs should be considered to be all of the attributes which are
   * supported by the caller and given as a list. The returned attributes will
   * only contain the attributes in the $pairs list.
   *
   * The $pairs value can be the default value or an array with:
   *    - [0] validation regex or `filter_var` flag
   *    - [1] default value
   *
   * If the $atts list has unsupported attributes, then they will be ignored and
   * removed from the final returned list.
   *
   * @since 0.1
   * @access public
   *
   * @param array $pairs Entire list of supported attributes and their defaults.
   * @param array $atts  User defined attributes in shortcode tag.
   * @return array Combined and filtered attribute list.
   */
  public function shortcode_atts($pairs, $atts)
  {
    $out = array();

    foreach ($pairs as $name => $default)
    {
      if (is_int($name))
      {
        $out[$default] = in_array($default, $atts);
      }
      else if (is_array($default))
      {
        if (array_key_exists($name, $atts))
        {
          if (in_array($default[0], self::$validation_flags))
          {
            $options = array('options' => array('default' => $default[1]));
            $out[$name] = filter_var($atts[$name], $default[0], $options);
          }
          else
          {
            $options = array('options' => array('default' => $default[1], 'regexp' => $default[0]));
            $out[$name] = filter_var($atts[$name], FILTER_VALIDATE_REGEXP, $options);
          }
        }
        else
        {
          $out[$name] = $default[1];
        }
      }
      else
      {
        if (array_key_exists($name, $atts))
        {
          $out[$name] = $atts[$name];
        }
        else
        {
          $out[$name] = $default;
        }
      }
    }

    return $out;
  }

  /**
   * Remove all shortcode tags from the given content.
   *
   * @since 0.1
   * @access public
   *
   * @param string $content Content to remove shortcode tags.
   * @return string Content without shortcode tags.
   */
  public function strip_shortcodes($content)
  {
    if (empty($this->shortcode_tags) || !is_array($this->shortcode_tags))
    {
      return $content;
    }

    $pattern = $this->__get_shortcode_regex();

    return preg_replace_callback(
      "/$pattern/s",
      array($this, '__strip_shortcode_tag'),
      $content
    );
  }

  /**
   * Strip shortcode tag
   *
   * @since 0.1
   * @access private
   *
   * @param $m
   * @return string
   */
  private function __strip_shortcode_tag($m)
  {
    // allow [[foo]] syntax for escaping a tag
    if ($m[1] == '[' && $m[6] == ']')
    {
      return substr($m[0], 1, -1);
    }

    return $m[1] . $m[6];
  }

}
