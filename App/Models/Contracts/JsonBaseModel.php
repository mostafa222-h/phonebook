<?php
namespace App\Models\Contracts ;
use App\Models\Contracts\BaseModel;

class JsonBaseModel extends BaseModel
{
    private $db_folder;
    private $table_filepath;
    public function __construct()
    {
        $this->db_folder = BASEPATH . "/Storage/jsondb/";
        $this->table_filepath = $this->db_folder . $this->table . '.json';
    }
   private function write_table(array $data)
   {
    $data_json = json_encode($data) ;
    file_put_contents($this->table_filepath,$data_json);
   }

   private function read_table():array
   {
    $table_data = json_decode(file_get_contents($this->table_filepath)) ;
    return $table_data;
   }
   #Create (insert)
   public function create(array $data):int
   {
    $table_data = $this->read_table();
    $table_data[] = $data ;
    $this->write_table($table_data);
        return $data[$this->primaryKey];
   }
   #Read (select) single | multiple
   public function find($id):object
   {
    $table_data = $this->read_table();
    foreach($table_data as $row)
    {
        if($row->{$this->primaryKey} == $id)
        {
            return $row;
        }
    }
    return null;
   }
   public function getAll():array
   {
      return $this->read_table();
   }
   public function get(array $columns  , array $where):array
   {
      return [];
   }
   #Update records
   public function update(array $data  , array $where): int
   {
     return 1;
   }
   #Delete
   public function delete(array $where): int
   {
     return 1;
   }
}