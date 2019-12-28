<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foundry
{
  /**
   * [PACKAGE description]
   * @var string
   */
  const PACKAGE = 'francis94c/foundry';

  /**
   * [__construct description]
   * @date 2019-12-28
   */
  function __construct()
  {
    get_instance()->load->package('splint/platform');

    splint_autoload_register(self::PACKAGE);

    get_instance()->load->splint(self::PACKAGE, '%foundry');
  }

  /**
   * [loadDependecies description]
   * @date 2019-12-28
   */
  public function loadDependecies():void
  {
    get_instance()->load->package('splint/platform');
  }

  public static function build(string $table, callable $buildCallable):void
  {
    $blueprint = new BluePrint();

    $buildCallable($blueprint);

    $blueprint->execute($table);
  }
}
