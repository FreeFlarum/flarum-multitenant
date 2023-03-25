<?php
/**
 * PHP Hooks Class
 *
 * The PHP Hooks Class is a fork of the WordPress filters hook system rolled in to a class to be ported
 * into any php based system
 *
 * This class is heavily based on the WordPress plugin API and most (if not all) of the code comes from there.
 *
 *
 * @version 0.4
 * @copyright 2012 - 2014
 * @author Ohad Raz <admin@bainternet.info>
 * @link http://en.bainternet.info
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
 * Hooks
 */
class Hooks
{
  /**
   * Default priority
   *
   * @since 0.2
   * @const int
   */
  const PRIORITY_NEUTRAL = 50;

  /**
   * Holds list of hooks
   *
   * @since 0.1
   * @var array
   */
  var $filters = array();

  /**
   * Holds the hit counters of each action
   *
   * @since 0.1
   * @var array
   */
  var $actions_hits = array();

  /**
   * Holds the call stack of filters
   *
   * @since 0.1
   * @var array
   */
  var $filters_stack = array();

  /**
   * Options
   *
   * @since 0.4
   * @var array
   */
  var $options = array();


  /**
   * __construct class constructor
   * @access public
   * @since 0.1
   */
  public function __construct($options = array())
  {
    $this->filters = array();
    $this->actions_hits = array();
    $this->filters_stack = array();

    $this->options = array_merge(array(
      'detect_loops' => true
    ), $options);
  }


  /**
   * FILTERS
   */

  /**
   * Hooks a function or method to a specific filter action.
   *
   * @access public
   * @since 0.1
   *
   * @param string   $tag             The name of the filter to hook the $function_to_add to.
   * @param callable $function_to_add The name of the function to be called when the filter is applied.
   * @param int      $priority        Optional. Used to specify the order in which the functions associated with
   *    a particular action are executed (default: 50). Lower numbers correspond with earlier execution,
   *    and functions with the same priority are executed in the order in which they were added to the action.
   * @param string   $include_path    Optional. File to include before executing the callback.
   * @param boolean  $enabled         Optional. State of the callback.
   * @return boolean true
   */
  public function add_filter($tag, $function_to_add, $priority = self::PRIORITY_NEUTRAL, $include_path = null, $enabled = true)
  {
    $idx = $this->__filter_build_unique_id($tag, $function_to_add, $priority);

    if (!isset($this->filters[$tag]))
    {
      $this->filters[$tag] = array(
        'enabled' => true,
        '_' => array(),
        );
    }

    $this->filters[$tag]['_'][$priority][$idx] = array(
      'function' => $function_to_add,
      'include_path' => is_string($include_path) ? $include_path : null,
      'enabled' => $enabled
      );


    ksort($this->filters[$tag]['_']);

    return true;
  }

  /**
   * Removes a function from a specified filter hook.
   *
   * @access public
   * @since 0.1
   *
   * @param string   $tag                The filter hook to which the function to be removed is hooked.
   * @param callable $function_to_remove The name of the function which should be removed.
   * @param int      $priority           Optional. The priority of the function (default: 50).
   * @return boolean Whether the function existed before it was removed.
   */
  public function remove_filter($tag, $function_to_remove, $priority = self::PRIORITY_NEUTRAL)
  {
    $function_to_remove = $this->__filter_build_unique_id($tag, $function_to_remove, $priority);
    $r = isset($this->filters[$tag]['_'][$priority][$function_to_remove]);

    if (true === $r)
    {
      unset($this->filters[$tag]['_'][$priority][$function_to_remove]);
      if (empty($this->filters[$tag]['_'][$priority]))
      {
        unset($this->filters[$tag]['_'][$priority]);
      }
    }

    return $r;
  }

  /**
   * Remove all of the hooks from a filter.
   *
   * @access public
   * @since 0.1
   *
   * @param string $tag      The filter to remove hooks from.
   * @param int|bool    $priority The priority number to remove.
   */
  public function remove_all_filters($tag, $priority = false)
  {
    if (isset($this->filters[$tag]))
    {
      if (false !== $priority)
      {
        if (isset($this->filters[$tag]['_'][$priority]))
        {
          unset($this->filters[$tag]['_'][$priority]);
          if (empty($this->filters[$tag]['_']))
          {
            unset($this->filters[$tag]);
          }
        }
      }
      else
      {
        unset($this->filters[$tag]);
      }
    }
  }

  /**
   *  Check if any filter has been registered for a hook.
   *
   * @access public
   * @since 0.1
   *
   * @param string   $tag               The name of the filter hook.
   * @param callable $function_to_check Optional.
   * @return mixed If $function_to_check is omitted, returns boolean for whether the hook has anything registered.
   *   When checking a specific function, the priority of that hook is returned, or false if the function is not attached.
   *   When using the $function_to_check argument, this function may return a non-boolean value that evaluates to false
   *   (e.g.) 0, so use the === operator for testing the return value.
   */
  public function has_filter($tag, $function_to_check = null)
  {
    $has = isset($this->filters[$tag]) && !empty($this->filters[$tag]['_']);
    if ($function_to_check === null)
    {
      return $has;
    }

    if (!$idx = $this->__filter_build_unique_id($tag, $function_to_check, false))
    {
      return false;
    }

    foreach (array_keys($this->filters[$tag]['_']) as $priority)
    {
      if (isset($this->filters[$tag]['_'][$priority][$idx]))
      {
        return $priority;
      }
    }

    return false;
  }

  /**
   * Disable a filter.
   *
   * @access public
   * @since 0.4
   *
   * @param string   $tag      The name of the filter hook.
   * @param callable $function Optional. Specific callback to disable.
   * @param int      $priority Optional. Priority of the callback to disable.
   * @return boolean If success.
   */
  public function disable_filter($tag, $function = null, $priority = self::PRIORITY_NEUTRAL)
  {
    return $this->__change_filter_state($tag, false, $function, $priority);
  }

  /**
   * Enable a filter.
   *
   * @access public
   * @since 0.4
   *
   * @param string   $tag      The name of the filter hook.
   * @param callable $function Optional. Specific callback to enable.
   * @param int      $priority Optional. Priority of the callback to enable.
   * @return boolean If success.
   */
  public function enable_filter($tag, $function = null, $priority = self::PRIORITY_NEUTRAL)
  {
    return $this->__change_filter_state($tag, true, $function, $priority);
  }

  /**
   * Call the functions added to a filter hook.
   *
   * @access public
   * @since 0.1
   *
   * @param string $tag     The name of the filter hook.
   * @param mixed  $value   The value on which the filters hooked to <tt>$tag</tt> are applied on.
   * @param mixed  $arg,... Additional variables passed to the functions hooked to <tt>$tag</tt>.
   * @return mixed The filtered value after all hooked functions are applied to it.
   */
  public function apply_filters($tag, $value)
  {
    if (!$this->has_filter($tag) || !$this->filters[$tag]['enabled'])
    {
      return $value;
    }

    $args = func_get_args();
    array_shift($args);

    $this->__bump_action($tag, $args);

    do {
      foreach (current($this->filters[$tag]['_']) as $the_)
      {
        if (!is_null($the_['function']) && $the_['enabled'])
        {
          if (!is_null($the_['include_path']))
          {
            include_once($the_['include_path']);
          }

          $args[0] = $value;
          $value = call_user_func_array($the_['function'], $args);
        }
      }
    }
    while (next($this->filters[$tag]['_']) !== false);

    array_pop($this->filters_stack);

    return $value;
  }

  /**
   * Execute functions hooked on a specific filter hook, specifying arguments in an array.
   *
   * @access public
   * @since 0.1
   *
   * @param string $tag  The name of the filter hook.
   * @param array  $args The arguments supplied to the functions hooked to <tt>$tag</tt>
   * @return mixed The filtered value after all hooked functions are applied to it.
   */
  public function apply_filters_ref_array($tag, $args)
  {
    if (!$this->has_filter($tag) || !$this->filters[$tag]['enabled'])
    {
      return $args[0];
    }

    $this->__bump_action($tag, $args);

    do
    {
      foreach (current($this->filters[$tag]['_']) as $the_)
      {
        if (!is_null($the_['function']) && $the_['enabled'])
        {
          if (!is_null($the_['include_path']))
          {
            include_once($the_['include_path']);
          }

          $args[0] = call_user_func_array($the_['function'], $args);
        }
      }
    }
    while (next($this->filters[$tag]['_']) !== false);

    array_pop($this->filters_stack);

    return $args[0];
  }


  /**
   * ACTIONS
   */

  /**
   * Hooks a function on to a specific action.
   *
   * @access public
   * @since 0.1
   *
   * @param string   $tag             The name of the action to which the $function_to_add is hooked.
   * @param callable $function_to_add The name of the function you wish to be called.
   * @param int      $priority        Optional. Used to specify the order in which the functions associated with
   *    a particular action are executed (default: 50). Lower numbers correspond with earlier execution,
   *    and functions with the same priority are executed in the order in which they were added to the action.
   * @param string   $include_path    Optional. File to include before executing the callback.
   * @param boolean  $enabled         Optional. State of the callback.
   * @return boolean true
   */
  public function add_action($tag, $function_to_add, $priority = self::PRIORITY_NEUTRAL, $include_path = null, $enable = true)
  {
    return $this->add_filter($tag, $function_to_add, $priority, $include_path, $enable);
  }

  /**
   * Check if any action has been registered for a hook.
   *
   * @access public
   * @since 0.1
   *
   * @param string   $tag               The name of the action hook.
   * @param callable $function_to_check Optional.
   * @return mixed If $function_to_check is omitted, returns boolean for whether the hook has anything registered.
   *   When checking a specific function, the priority of that hook is returned, or false if the function is not attached.
   *   When using the $function_to_check argument, this function may return a non-boolean value that evaluates to false
   *   (e.g.) 0, so use the === operator for testing the return value.
   */
  public function has_action($tag, $function_to_check = null)
  {
    return $this->has_filter($tag, $function_to_check);
  }

  /**
   * Removes a function from a specified action hook.
   *
   * @access public
   * @since 0.1
   *
   * @param string   $tag                The action hook to which the function to be removed is hooked.
   * @param callable $function_to_remove The name of the function which should be removed.
   * @param int      $priority           Optional. The priority of the function (default: 50).
   * @return boolean Whether the function is removed.
   */
  public function remove_action($tag, $function_to_remove, $priority = self::PRIORITY_NEUTRAL)
  {
    return $this->remove_filter($tag, $function_to_remove, $priority);
  }

  /**
   * Remove all of the hooks from an action.
   *
   * @access public
   * @since 0.1
   *
   * @param string $tag      The action to remove hooks from.
   * @param int|bool    $priority The priority number to remove them from.
   * @return bool True when finished.
   */
  public function remove_all_actions($tag, $priority = false)
  {
    return $this->remove_all_filters($tag, $priority);
  }

  /**
   * Disable an action.
   *
   * @access public
   * @since 0.4
   *
   * @param string   $tag      The name of the action hook.
   * @param callable $function Optional. Specific callback to disable.
   * @param int      $priority Optional. Priority of the callback to disable.
   * @return boolean If success.
   */
  public function disable_action($tag, $function = null, $priority = self::PRIORITY_NEUTRAL)
  {
    return $this->disable_filter($tag, $function, $priority);
  }

  /**
   * Enable an action.
   *
   * @access public
   * @since 0.4
   *
   * @param string   $tag      The name of the action hook.
   * @param callable $function Optional. Specific callback to enable.
   * @param int      $priority Optional. Priority of the callback to enable.
   * @return boolean If success.
   */
  public function enable_action($tag, $function = null, $priority = self::PRIORITY_NEUTRAL)
  {
    return $this->enable_filter($tag, $function, $priority);
  }

  /**
   * Execute functions hooked on a specific action hook.
   *
   * @access public
   * @since 0.1
   *
   * @param string $tag     The name of the action to be executed.
   * @param mixed  $arg,... Optional additional arguments which are passed on to the functions hooked to the action.
   * @return void Will return null if $tag does not exist in $filter array
   */
  public function do_action($tag)
  {
    if (!$this->has_filter($tag) || !$this->filters[$tag]['enabled'])
    {
      return;
    }

    $args = func_get_args();
    array_shift($args);

    $this->__bump_action($tag, $args);

    do
    {
      foreach (current($this->filters[$tag]['_']) as $the_)
      {
        if (!is_null($the_['function']) && $the_['enabled'])
        {
          if (!is_null($the_['include_path']))
          {
            include_once($the_['include_path']);
          }

          call_user_func_array($the_['function'], $args);
        }
      }
    }
    while (next($this->filters[$tag]['_']) !== false);

    array_pop($this->filters_stack);
  }

  /**
   * Execute functions hooked on a specific action hook, specifying arguments in an array.
   *
   * @access public
   * @since 0.1
   *
   * @param string $tag The name of the action to be executed.
   * @param array $args The arguments supplied to the functions hooked to <tt>$tag</tt>
   * @return void Will return null if $tag does not exist in $filter array
   */
  public function do_action_ref_array($tag, $args)
  {
    if (!$this->has_filter($tag) || !$this->filters[$tag]['enabled'])
    {
      return;
    }

    $this->__bump_action($tag, $args);

    do
    {
      foreach (current($this->filters[$tag]['_']) as $the_)
      {
        if (!is_null($the_['function']) && $the_['enabled'])
        {
          if (!is_null($the_['include_path']))
          {
            include_once($the_['include_path']);
          }

          call_user_func_array($the_['function'], $args);
        }
      }
    }
    while (next($this->filters[$tag]['_']) !== false);

    array_pop($this->filters_stack);
  }


  /**
   * HELPERS
   */

  /**
   * Retrieve the name of the current filter or action.
   *
   * @access public
   * @since 0.1
   *
   * @return string Hook name of the current filter or action.
   */
  public function current_filter()
  {
    return end($this->filters_stack);
  }

  /**
   * Retrieve the name of the current action.
   *
   * @access public
   * @since 0.1.2
   *
   * @return string Hook name of the current action.
   */
  public function current_action()
  {
    return $this->current_filter();
  }

  /**
   * Retrieve the name of a filter currently being processed.
   *
   * The function current_filter() only returns the most recent filter or action
   * being executed. did_action() returns true once the action is initially
   * processed. This function allows detection for any filter currently being
   * executed (despite not being the most recent filter to fire, in the case of
   * hooks called from hook callbacks) to be verified.
   *
   * @since 0.1.2
   * @access public
   * @see did_action()
   *
   * @param null|string $filter Optional. Filter to check. Defaults to null, which
   *                            checks if any filter is currently being run.
   * @return bool Whether the filter is currently in the stack
   */
  public function doing_filter($filter = null)
  {
    if (null === $filter)
    {
      return !empty($this->filters_stack);
    }

    foreach ($this->filters_stack as $stack)
    {
      if ($stack[0] == $filter)
      {
        return true;
      }
    }

    return false;
  }

  /**
   * Retrieve the name of an action currently being processed.
   *
   * @since 0.1.2
   * @access public
   *
   * @param string|null $action Optional. Action to check. Defaults to null, which checks
   *                            if any action is currently being run.
   * @return bool Whether the action is currently in the stack.
   */
  public function doing_action($action = null)
  {
    return $this->doing_filter($action);
  }

  /**
   * Retrieve the number of times an filter was used.
   *
   * @access public
   * @since 0.3
   *
   * @param string $tag The name of the filter hook.
   * @return int The number of times action hook <tt>$tag</tt> is fired
   */
  public function did_filter($tag)
  {
    if (!isset($this->actions_hits[$tag]))
    {
      return 0;
    }

    return $this->actions_hits[$tag];
  }

  /**
   * Retrieve the number of times an action is fired.
   *
   * @access public
   * @since 0.1
   *
   * @param string $tag The name of the action hook.
   * @return int The number of times action hook <tt>$tag</tt> is fired
   */
  public function did_action($tag)
  {
    return $this->did_filter($tag);
  }

  /**
   * Build Unique ID for storage and retrieval.
   *
   * @since 0.1
   * @access private
   *
   * @param string   $tag      Used in counting how many hooks were applied
   * @param callable $function Used for creating unique id
   * @param int|bool $priority Used in counting how many hooks were applied. If === false and $function
   *    is an object reference, we return the unique id only if it already has one, false otherwise.
   * @return string|bool Unique ID for usage as array key or false if $priority === false and $function
   *    is an object reference, and it does not already have a unique id.
   */
  private function __filter_build_unique_id($tag, $function, $priority)
  {
    static $filter_id_count = 0;

    if (is_string($function))
    {
      return $function;
    }

    if (is_object($function))
    {
      // Closures are currently implemented as objects
      $function = array($function, '');
    }
    else
    {
      $function = (array)$function;
    }

    if (is_object($function[0]))
    {
      // Object Class Calling
      if (function_exists('spl_object_hash'))
      {
        return spl_object_hash($function[0]).$function[1];
      }
      else
      {
        $obj_idx = get_class($function[0]).$function[1];

        if (!isset($function[0]->filter_id))
        {
          if (false === $priority)
          {
            return false;
          }

          $obj_idx.= isset($this->filters[$tag]['_'][$priority]) ? count((array)$this->filters[$tag]['_'][$priority]) : $filter_id_count;
          $function[0]->filter_id = $filter_id_count;
          ++$filter_id_count;
        }
        else
        {
          $obj_idx.= $function[0]->filter_id;
        }

        return $obj_idx;
      }
    }
    else if (is_string($function[0]))
    {
      // Static Calling
      return $function[0].$function[1];
    }
    return false;
  }

  /**
   * Common script before running an action or applying a filter:
   *    - increase hits count
   *    - add to stack
   *    - filter hooks by priority
   *
   * @since 0.3
   * @access private
   *
   * @param string $tag
   * @param array $args
   */
  private function __bump_action($tag, $args)
  {
    if (!isset($this->actions_hits[$tag]))
    {
      $this->actions_hits[$tag] = 1;
    }
    else
    {
      ++$this->actions_hits[$tag];
    }

    if ($this->options['detect_loops'])
    {
      $args_hash = md5(json_encode($args));

      foreach ($this->filters_stack as $stack)
      {
        if ($stack[0] == $tag && $stack[1] = $args_hash)
        {
          throw new \Exception(get_class() . ': recursive nested hook detected');
        }
      }

      $this->filters_stack[] = array($tag, $args_hash);
    }
    else
    {
      $this->filters_stack[] = array($tag);
    }

    reset($this->filters[$tag]['_']);
  }

  /**
   * Common function to change filter state.
   *
   * @access public
   * @since 0.4
   *
   * @param string   $tag
   * @param boolean  $state
   * @param callable|null $function
   * @param int      $priority
   * @return boolean If success.
   */
  private function __change_filter_state($tag, $state, $function, $priority)
  {
    if (!$this->has_filter($tag))
    {
      return false;
    }

    if ($function === null)
    {
      $this->filters[$tag]['enabled'] = $state;

      return true;
    }
    else
    {
      $idx = $this->__filter_build_unique_id($tag, $function, $priority);

      if (isset($this->filters[$tag]['_'][$priority][$idx]))
      {
        $this->filters[$tag]['_'][$priority][$idx]['enabled'] = $state;

        return true;
      }
    }

    return false;
  }

}
