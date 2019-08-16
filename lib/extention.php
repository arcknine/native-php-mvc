<?php
class Extention extends ActiveRecord
{
  var $data;

  public function __construct($data = [])
  {
    $this->data =& $data;
  }

  public function limit($limit = 1, $offset = 0)
  {
    $this->data->sql .= " LIMIT {$limit}";
    dd($this);
  }
}