<?php
class ActiveRecord
{
  protected $conn;
  var $data, $table, $s, $time_now, $statement, $sql;

  public function __construct($data = [])
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

    $this->sql = "INSERT INTO {$this->table} ({$keys}) VALUES ({$values})";

    $this->execute_query($sql);
    $this->statement->execute();
    $this->statement->close();

    return true;
  }

  public function all()
  {
    $this->sql = "SELECT * FROM {$this->table}";
    // $result = $this->conn->query($this->sql);
    // $data = [];
    // while($row = $result->fetch_assoc())
    // {
    //   $data[] = $row;
    // }

    return new Extention($this);
  }

  public function where($args = [])
  {

  }

  private function getDbTableName()
  {
    return pluralize(strtolower(get_class($this)));
  }

  private function execute_query()
  {
    if ($this->statement = $this->conn->prepare($this->sql))
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

      // dd($sql);
      call_user_func_array(array($this->statement, 'bind_param'), $bind_names);
      return true;
    }
  }
}