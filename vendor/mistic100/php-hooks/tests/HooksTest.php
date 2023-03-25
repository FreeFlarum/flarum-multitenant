<?php

use Hooks\Hooks;

class HooksTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Hooks
     */
  private  $hooks;

  public function setUp()
  {
    $this->hooks = new Hooks();

  }
  
  public function testAction()
  {
    $done = false;
    
    $this->hooks->add_action('foo', function() use(&$done) {
      $done = !$done;
    });
    
    $this->hooks->do_action('foo');
    $this->assertTrue($done);
  }
  
  public function testFilter()
  {
    $content = 'Hello world';
    
    $this->hooks->add_filter('foo', function($content) {
      return '<b>' . $content . '</b>';
    });
    
    $this->assertEquals($this->hooks->apply_filters('foo', $content), '<b>Hello world</b>');
  }
  
  public function testMultipleFiltersAndPriority()
  {
    // Lower priority should be executed first.
    $content = 'Hello world';

    $this->hooks->add_filter('html', function($content) { return '<b>' . $content . '</b>'; }, 20);
    $this->hooks->add_filter('html', function($content) { return '<i>' . $content . '</i>'; }, 10);

    $retval = $this->hooks->apply_filters('html', $content);
    $this->assertEquals($retval, '<b><i>Hello world</i></b>');
  }

  public function testMultipleArgumentsToFilter()
  {

    $this->hooks->add_filter('html', function($arg1, $extra, $args) { return 'arg1' . $extra . $args; });

    $retval = $this->hooks->apply_filters('html', 'arg1', 'extra', 'args');

    $this->assertEquals($retval, 'arg1extraargs');
  }

  public function testMultipleFiltersMultipleArguments()
  {

    $this->hooks->add_filter('html', function($arg1, $arg2) {  return "a[{$arg1}:{$arg2}]"; }, 20);
    $this->hooks->add_filter('html', function($arg1, $arg2) {  return "b({$arg1}:{$arg2})"; }, 10);

    $retval = $this->hooks->apply_filters('html', 'arg1', 'arg2');

    $this->assertEquals($retval, 'a[b(arg1:arg2):arg2]');
  }
  /**
   * @expectedException              \Exception
   * @expectedExceptionMessageRegExp /.* recursive nested hook detected/
   */
  public function testRecursiveException()
  {
    $this->hooks->add_action('foo', function() {
      $this->hooks->do_action('bar');
    });
    
    $this->hooks->add_action('bar', function() {
      $this->hooks->do_action('foo');
    });
    
    $this->hooks->do_action('foo');
  }
  
  public function testRemoveHandler()
  {
    $done = false;
    
    $do = function() use(&$done) {
      $done = !$done;
    };
    
    $this->hooks->add_action('foo', $do);
    $this->hooks->remove_action('foo', $do);
    
    $this->hooks->do_action('foo');
    $this->assertFalse($done);
  }
  
  public function testDisableHandler()
  {
    $done = false;
    
    $do = function() use(&$done) {
      $done = !$done;
    };
    
    $this->hooks->add_action('foo', $do);
    $this->hooks->disable_action('foo', $do);
    
    $this->hooks->do_action('foo');
    $this->assertFalse($done);
    
    $this->hooks->enable_action('foo', $do);
    
    $this->hooks->do_action('foo');
    $this->assertTrue($done);
    
    $this->hooks->disable_action('foo');
    
    $this->hooks->do_action('foo');
    $this->assertTrue($done);
    
    $this->hooks->enable_action('foo');
    
    $this->hooks->do_action('foo');
    $this->assertFalse($done);
  }
  
}
