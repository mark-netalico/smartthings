<?php namespace Netalico\Smartthings\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Locks extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'locks'; }
 
}