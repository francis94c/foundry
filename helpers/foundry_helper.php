<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('blueprint_field')) {
  function blueprint_field(string $type, $constraint=null, bool $autoIncrement=false,
  $null=true, bool $unique=false, $default=null)
  {
    $field = ['type' => $type];

    if ($constraint) $field['constraint'] = $constraint;
    if ($autoIncrement) $field['auto_increment'] = true;
    if (!$null) $field['null'] = false;
    if ($unique) $field['unique'] = true;
    if ($default) $field['default'] = $default;

    return $field;
  }
}
