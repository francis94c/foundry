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

  /**
   * [private description]
   * @var [type]
   */
  private $primaryKeys = [];

  /**
   * [private description]
   * @var [type]
   */
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
    $fieldBluePrint->autoIncrement = true;
    $fieldBluePrint->primaryKey = true;
    return $this->fields[] = $fieldBluePrint;
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
    return $this->fields[] = new FieldBluePrint($field, 'VARCHAR', $length);
  }

  /**
   * [char description]
   * @date   2019-12-30
   * @param  string         $field  [description]
   * @param  integer        $length [description]
   * @return FieldBluePrint         [description]
   */
  public function &char(string $field, int $length=50):FieldBluePrint
  {
    return $this->fields[] = new FieldBluePrint($field, 'CHAR', $length);
  }

  /**
   * [date description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &date(string $field):FieldBluePrint
  {
    return $this->fields[] = new FieldBluePrint($field, 'DATE');
  }

  /**
   * [dateTime description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &dateTime(string $field):FieldBluePrint
  {
    return $this->fields[] = new FieldBluePrint($field, 'DATE', $length);
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
    return $this->fields[] = $fieldBluePrint;
  }

  /**
   * [binary description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &binary(string $field):FieldBluePrint
  {
    return $this->fields[] = new FieldBluePrint($field, 'BLOB');
  }

  /**
   * [boolean Creates a Boolean Field.]
   * @date   2019-12-30
   * @param  string         $field Field Name.
   * @return FieldBluePrint        Pointer for Chaining.
   */
  public function &boolean(string $field):FieldBluePrint
  {
    return $this->fields[] = new FieldBluePrint($field, 'BOOLEAN');
  }

  /**
   * [bigInteger description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &bigInteger(string $field):FieldBluePrint
  {
    $this->fields[] = new FieldBluePrint($field, 'BIGINT');
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [enum description]
   * @date   2019-12-29
   * @param  string         $field  [description]
   * @param  array          $values [description]
   * @return FieldBluePrint         [description]
   */
  public function &enum(string $field, array $values):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'ENUM(\''.implode("','", $values).'\')');
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [primary description]
   * @date   2019-12-29
   * @param  string|array   $field [description]
   *
   * @throws Exception      When given data type is invalid.
   *
   * @return FieldBluePrint        [description]
   */
  public function &primary($field):?FieldBluePrint
  {
    if (is_scalar($field) && is_string($field)) {
      $this->primaryKeys[] = $field;
      for ($x = 0; $x < count($this->fields); $x++) {
        if ($this->fields[$x]->name == $field) {
          return $this->fields[$x];
        }
      }
    } elseif (is_array($field)) {
      $this->compoundKeys[] = $field;
    } else {
      throw new Exception("Invalid Data Type, Function 'primary' expects string or array as argument.");
    }

    return null;
  }

  /**
   * [double description]
   * @date   2019-12-29
   * @param  string         $field [description]
   * @param  [type]         $m     [description]
   * @param  [type]         $d     [description]
   * @return FieldBluePrint        [description]
   */
  public function &double(string $field, ?int $m=null, ?int $d=null):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'DOUBLE');
    if ($m && $d) $fieldBluePrint->constraint = "$m,$d";
    return $this->fields[] = $fieldBluePrint;
  }

  /**
   * [decimal description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @param  [type]         $m     [description]
   * @param  [type]         $d     [description]
   * @return FieldBluePrint        [description]
   */
  public function &decimal(string $field, ?int $m=null, ?int $d=null):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'DECIMAL');
    if ($m && $d) $fieldBluePrint->constraint = "$m,$d";
    return $this->fields[] = $fieldBluePrint;
  }

  /**
   * [float description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @param  [type]         $m     [description]
   * @param  [type]         $d     [description]
   * @return FieldBluePrint        [description]
   */
  public function &float(string $field, ?int $m=null, ?int $d=null):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'FLOAT');
    if ($m && $d) $fieldBluePrint->constraint = "$m,$d";
    return $this->fields[] = $fieldBluePrint;
  }

  /**
   * [tinyInteger description]
   * @date   2019-12-29
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &tinyInteger(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'TINYINT');
    return $this->fields[] = $fieldBluePrint;
  }

  /**
   * [geometry description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &geometry(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'GEOMETRY');
    return $this->fields[] = $fieldBluePrint;
  }

  /**
   * [point description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &point(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'POINT');
    return $this->fields[] = $fieldBluePrint;
  }

  /**
   * [foreign description]
   * @date   2019-12-29
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &foreign(string $field):?FieldBluePrint
  {
    for ($x = 0; $x < count($this->fields); $x++) {
      if ($this->fields[$x]->name == $field) {
        $this->fields[$x]->foreign();
        return $this->fields[$x];
      }
    }

    return null;
  }

  /**
   * [engine description]
   * @date  2019-12-29
   * @param string     $engine [description]
   */
  public function engine(string $engine):void
  {
    $this->engine = $engine;
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

    $foreignKeys = [];

    foreach ($this->fields as $field) {
      if ($field->primaryKey) $this->primaryKeys[] = $field->name;

      if ($field->hasForeignKeyConstraint()) {
        $foreignKeys[] = $field->getForeignKey($table);
      }

      $fields[$field->name] = $field->build();
    }

    get_instance()->dbforge->add_field($fields);

    foreach($this->primaryKeys as $primaryKey) {
      get_instance()->dbforge->add_key($primaryKey, true);
    }

    foreach ($foreignKeys as $foreignKey) {
      get_instance()->dbforge->add_field($foreignKey);
    }

    get_instance()->dbforge->create_table($table, true, [
      'ENGINE' => $this->engine
    ]);
  }
}
