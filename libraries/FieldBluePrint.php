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

  /**
   * [public description]
   * @var [type]
   */
  public $default;

  /**
   * [public description]
   * @var [type]
   */
  public $null = false;
  public $alter = false;
  public $autoIncrement = false;
  public $primaryKey = false;
  public $unsigned = true;
  private $foreignKey = [];

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
   * [primary description]
   * @date   2019-12-29
   * @return FieldBluePrint [description]
   */
  public function primary():FieldBluePrint
  {
    $this->primaryKey = true;
    return $this;
  }

  /**
   * [foreign description]
   * @date   2019-12-29
   * @return FieldBluePrint        [description]
   */
  public function foreign():FieldBluePrint
  {
    $this->foreignKey[0] = $this->name;
    return $this;
  }

  /**
   * [references description]
   * @date   2019-12-29
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function references(string $field):FieldBluePrint
  {
    $this->foreignKey[1] = $field;
    return $this;
  }

  /**
   * [on description]
   * @date   2019-12-29
   * @param  string         $table [description]
   * @return FieldBluePrint        [description]
   */
  public function on(string $table):FieldBluePrint
  {
    $this->foreignKey[2] = $table;
    return $this;
  }

  /**
   * [hasForeignKeyConstraint description]
   * @date   2019-12-29
   * @return bool       [description]
   */
  public function hasForeignKeyConstraint():bool
  {
    return ($this->foreignKey[0] ?? false) && ($this->foreignKey[1] ?? false) && ($this->foreignKey[2] ?? false);
  }

  /**
   * [onDelete description]
   * @date   2019-12-29
   * @param  string         $onDelete [description]
   * @return FieldBluePrint           [description]
   */
  public function onDelete(string $onDelete):FieldBluePrint
  {
    $this->foreignKey['on_delete'] = strtoupper($onDelete);
    return $this;
  }

  /**
   * [onUpdate description]
   * @date   2019-12-29
   * @param  string         $onUpdate [description]
   * @return FieldBluePrint           [description]
   */
  public function onUpdate(string $onUpdate):FieldBluePrint
  {
    $this->foreignKey['on_update'] = strtoupper($onUpdate);
    return $this;
  }

  /**
   * [getForeignKey description]
   * @date   2019-12-29
   * @return string     [description]
   */
  public function getForeignKey(string $table):string
  {
    return @"CONSTRAINT {$table}_{$this->foreignKey[0]}_foreign FOREIGN KEY
    ({$this->foreignKey[0]}) REFERENCES {$this->foreignKey[2]}({$this->foreignKey[1]})"
    .(isset($this->foreignKey['on_update']) ? " ON UPDATE {$this->foreignKey['on_update']}" : '')
    .(isset($this->foreignKey['on_delete']) ? " ON DELETE {$this->foreignKey['on_delete']}" : '');
  }

  /**
   * [useCurrent description]
   * @date   2019-12-30
   * @return FieldBluePrint [description]
   */
  public function &useCurrent():FieldBluePrint
  {
    if ($this->type == 'DATE') {
      $this->default('CURRENT_TIMESTAMP');
    }
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

  /**
   * [build description]
   * @date   2019-12-29
   * @return array      [description]
   */
  public function build():array
  {
    $field = ['type' => $this->type];

    if ($this->constraint) $field['constraint'] = $this->constraint;
    if ($this->autoIncrement) $field['auto_increment'] = true;
    if (!$this->null) $field['null'] = false; // Default True;
    if (!$this->unsigned) $field['unsigned'] = false; // Default True.
    if ($this->unique) $field['unique'] = true;
    if ($this->default) $field['default'] = $this->default;

    return $field;
  }
}
