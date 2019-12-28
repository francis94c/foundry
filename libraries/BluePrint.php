<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BluePrint
{
  /**
   * [private description]
   * @var [type]
   */
  private $fields = [];

  /**
   * [private description]
   * @var [type]
   */
  private $engine = 'InnoDB';

  private $primaryKeys = [];

  private $compoundKeys = [];

  /**
   * [increments description]
   * @date   2019-12-28
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &increments(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'INT');
    $fieldBluePrint->$autoIncrement = true;
    $fieldBluePrint->primaryKey = true;
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }
  /**
   * [bigIncrements description]
   * @date   2019-12-28
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &bigIncrements(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'BIGINT');
    $fieldBluePrint->$autoIncrement = true;
    $fieldBluePrint->primaryKey = true;
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [string description]
   * @date   2019-12-28
   * @param  string     $field  [description]
   * @param  integer    $length [description]
   * @return BluePrint          [description]
   */
  public function &string(string $field, int $length=100):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'VARCHAR', $length);
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [integer description]
   * @date   2019-12-28
   * @param  string         $field  [description]
   * @param  [type]         $length [description]
   * @return FieldBluePrint         [description]
   */
  public function &integer(string $field, ?int $length=null):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'INT');
    if ($length) $fieldBluePrint->constraint = $length;
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [execute description]
   * @date   2019-12-28
   * @param  string     $table [description]
   * @return [type]            [description]
   */
  public function execute(string $table)
  {
    $this->primaryKeys = array_unique($this->primaryKey);

    $fields = [];

    foreach ($this->fields as $field) {
      if ($field->primaryKey) $this->primaryKeys[] = $field->name;
      $fields[$field->name] = $field->build();
    }

    get_instance()->db->query("SET default_storage_engine=$this->engine;");

    get_instance()->dbforge->add_field($fields);

    foreach($this->primaryKeys as $primaryKey) {
      get_instance()->dbforge->add_key($primaryKey, true);
    }

    get_instance()->dbforge->create_table($table);
  }
}
