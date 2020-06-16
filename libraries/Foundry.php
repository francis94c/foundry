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

  /**
   * [build description]
   * @date  2019-12-29
   * @param string     $table         [description]
   * @param callable   $buildCallable [description]
   */
  public static function build(string $table, callable $buildCallable):void
  {
    $blueprint = new BluePrint();

    $buildCallable($blueprint);

    $blueprint->execute($table);
  }

  /**
   * [drop description]
   * @date  2019-12-29
   * @param string     $table [description]
   */
  public function drop(string $table):void
  {
    $this->dbforge->drop_table($table);
  }
}
