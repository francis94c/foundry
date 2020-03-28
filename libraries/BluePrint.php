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
   * [private description]
   * @var [type]
   */
  private $comment;

  /**
   * [private description]
   * @var [type]
   */
  private $indices = [];

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
    $this->fields[] = new FieldBluePrint($field, 'VARCHAR', $length);
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [index description]
   * @date   2020-01-06
   * @param  [type]         $index [description]
   * @return FieldBluePrint        [description]
   */
  public function &index($index):FieldBluePrint
  {
    if (is_array($index)) {
      array_merge($this->indices, $index);
    } else {
      $this->indices[] = $index;
    }
    return $this;
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
    $this->fields[] = new FieldBluePrint($field, 'CHAR', $length);
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [date description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &date(string $field):FieldBluePrint
  {
    $this->fields[] = new FieldBluePrint($field, 'DATE');
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [dateTime description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &dateTime(string $field):FieldBluePrint
  {
    $this->fields[] = new FieldBluePrint($field, 'DATETIME');
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
   * [binary description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &binary(string $field):FieldBluePrint
  {
    $this->fields[] = new FieldBluePrint($field, 'BLOB');
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [boolean Creates a Boolean Field.]
   * @date   2019-12-30
   * @param  string         $field Field Name.
   * @return FieldBluePrint        Pointer for Chaining.
   */
  public function &boolean(string $field):FieldBluePrint
  {
    $this->fields[] = new FieldBluePrint($field, 'BOOLEAN');
    return $this->fields[count($this->fields) - 1];
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
    $this->fields[count($this->fields) - 1];
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [timestamp description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &timestamp(string $field):FieldBluePrint
  {
    $this->fields[] = new FieldBluePrint($field, 'TIMESTAMP');
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [timestamps description]
   * @date 2019-12-30
   */
  public function timestamps():void
  {
    ($this->fields[] = new FieldBluePrint('created_at', 'TIMESTAMP'))->useCurrent()->nullable(false);
    $fieldBluePrint = new FieldBluePrint('updated_at', 'TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    $this->fields[] = $fieldBluePrint->useCurrent()->nullable(false);
  }

  /**
   * [text description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &text(string $field):FieldBluePrint
  {
    $this->fields[] = new FieldBluePrint($field, 'TEXT');
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
    //$fieldBluePrint = new FieldBluePrint($field, 'ENUM(\''.implode("','", $values).'\')');
    $fieldBluePrint = new FieldBluePrint($field, 'ENUM', $values);
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [set description]
   * @date   2019-12-30
   * @param  string         $field  [description]
   * @param  array          $values [description]
   * @return FieldBluePrint         [description]
   */
  public function &set(string $field, array $values):FieldBluePrint
  {
    //$fieldBluePrint = new FieldBluePrint($field, 'SET(\''.implode("','", $values).'\')');
    $fieldBluePrint = new FieldBluePrint($field, 'SET', $values);
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
   * @return FieldBluePrint|BluePrint [description]
   */
  public function &primary($field)
  {
    if (is_scalar($field) && is_string($field)) {
      $this->primaryKeys[] = $field;
      for ($x = 0; $x < count($this->fields); $x++) {
        if ($this->fields[$x]->name == $field) {
          return $this->fields[$x];
        }
      }
    } elseif (is_array($field)) {
      $this->primaryKeys = array_merge($this->primaryKeys, $field);
      return $this;
    } else {
      throw new Exception("Invalid Data Type, Function 'primary' expects string or array as argument.");
    }

    throw new Exception("Could not set primary key on '$field' as it was not found.");
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
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
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
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
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
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
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
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
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
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [geometryCollection description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &geometryCollection(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'GEOMETRYCOLLECTION');
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [ipAddress description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &ipAddress(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'INT');
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [lineString description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &lineString(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'LINESTRING');
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [longText description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &longText(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'LONGTEXT');
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [json description]
   * @date   2019-12-30
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &json(string $field):FieldBluePrint
  {
    $fieldBluePrint = new FieldBluePrint($field, 'JSON');
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [comment description]
   * @date   2019-12-31
   * @param  string     $tableComment  [description]
   * @param  [type]     $columnComment [description]
   * @return [type]                    [description]
   */
  public function &comment(string $tableComment, string $columnComment=null)
  {
    if (!$columnComment) {
      $this->comment = $tableComment;
      return $this;
    }

    for ($x = 0; $x < count($this->fields); $x++) {
      if ($this->fields[$x]->name == $tableComment) {
        return $this->fields[$x]->comment($columnComment);
      }
    }

    throw new Exception("Comment not set, Could not find field $tableComment");
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
    $this->fields[] = $fieldBluePrint;
    return $this->fields[count($this->fields) - 1];
  }

  /**
   * [foreign description]
   * @date   2019-12-29
   * @param  string         $field [description]
   * @return FieldBluePrint        [description]
   */
  public function &foreign(string $field):FieldBluePrint
  {
    for ($x = 0; $x < count($this->fields); $x++) {
      if ($this->fields[$x]->name == $field) {
        $this->fields[$x]->foreign();
        return $this->fields[$x];
      }
    }

    throw new Exception("Could not set Foreign Key, Field: '$field' not found.");
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
    $this->primaryKeys = array_unique($this->primaryKeys);

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

    $tableMetaData = [
      'ENGINE' => $this->engine
    ];

    if ($this->comment) $tableMetaData['COMMENT'] = "'$this->comment'";

    get_instance()->dbforge->create_table($table, true, $tableMetaData);
  }
}
