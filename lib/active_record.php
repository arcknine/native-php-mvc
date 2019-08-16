<?php
class ActiveRecord
{
  protected $conn;
  var $data, $table, $s, $time_now;

  public function __construct($data)
  {
    global $connection;
    $this->conn =& $connection;
    $this->data =& $data;
    $this->time_now = date("Y-m-d H:i:s");
    $this->table = $this->getDbTableName();
  }

  public function create()
  {
    $this->data['created_at'] = $this->time_now;
    $this->data['updated_at'] = $this->time_now;

    $keys = implode(', ', array_keys($this->data));
    $values = array();
    $this->s = '';

    foreach (array_values($this->data) as $value)
    {
      array_push($values, "?");
      $this->s .= 's';
    }
    $values = implode(', ', $values);

    $sql = "INSERT INTO {$this->table} ({$keys}) VALUES ({$values})";

    return $this->execute_query($sql);
  }

  private function getDbTableName()
  {
    return pluralize(strtolower(get_class($this)));
  }

  private function execute_query($sql)
  {
    if ($stmt = $this->conn->prepare($sql))
    {
      $i = 0;
      $bind_names = [$this->s];
      foreach (array_keys($this->data) as $key)
      {
        $bind_name = $key;
        $$bind_name = $this->data[$key];
        $bind_names[] =& $$bind_name;
        $i += 1;
      }

      call_user_func_array(array($stmt, 'bind_param'), $bind_names);

      $stmt->execute();
      $stmt->close();

      return true;
    }
  }
}