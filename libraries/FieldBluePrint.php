<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FieldBluePrint
{
  /**
   * [private description]
   * @var [type]
   */
  public $name;

  /**
   * [public description]
   * @var [type]
   */
  public $type;

  /**
   * [public description]
   * @var [type]
   */
  public $constraint;

  /**
   * [public description]
   * @var [type]
   */
  public $unique;
  public $default;
  public $null = false;
  public $alter = false;
  public $autoIncrement = false;
  public $primaryKey = false;

  /**
   * [__construct description]
   * @date  2019-12-28
   * @param string     $name       [description]
   * @param [type]     $constraint [description]
   */
  function __construct(string $name, string $type, ?int $constraint=null)
  {
    $this->name = $name;
    $this->type = $type;
    $this->constraint = $constraint;
  }

  /**
   * [nullable description]
   * @date   2019-12-28
   * @return FieldBluePrint [description]
   */
  public function nullable():FieldBluePrint
  {
    $this->null = true;
    return $this;
  }

  /**
   * [unique description]
   * @date   2019-12-28
   * @return FieldBluePrint [description]
   */
  public function unique():FieldBluePrint
  {
    $this->unique = true;
    return $this;
  }

  /**
   * [default description]
   * @date   2019-12-28
   * @param  [type]         $default [description]
   * @return FieldBluePrint          [description]
   */
  public function default($default):FieldBluePrint
  {
    $this->default = $default;
    return $this;
  }

  public function build():array
  {
    $field = ['type' => $this->type];

    if ($this->constraint) $field['constraint'] = $this->constraint;
    if ($this->autoIncrement) $field['auto_increment'] = true;
    if (!$this->null) $field['null'] = false;
    if ($this->unique) $field['unique'] = true;
    if ($this->default) $field['default'] = $this->default;

    return $field;
  }
}
