<?php
namespace App\Models\Contracts ;
use App\Models\Contracts\BaseModel;
use Medoo\Medoo;

class MysqlBaseModel extends BaseModel
{


    public function __construct($id = null)
   {
    // try {
    //     $this->connection= new \PDO("mysql:dbname={$_ENV['DB_NAME']};host={$_ENV['DB_HOST']}",$_ENV['DB_USER'],$_ENV['DB_PASS']) ;
    //     $this->connection->exec("set names utf8;");
    // }catch(PDOException $e){
    //     echo('connection failed :' . $e->getMessage()); die();
    // }


    $this->connection = new Medoo([

        'type' => 'mysql',
        'host' => $_ENV['DB_HOST'],
        'database' => $_ENV['DB_NAME'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
     
       
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'port' => 3306,
      
        'logging' => true,
    
        'error' => \PDO::ERRMODE_EXCEPTION,
     
        'command' => [
            'SET SQL_MODE=ANSI_QUOTES'
        ]
    ]);
    if(!is_null($id))
    {
        return $this->find($id);
    }
    
    
   }

   public function remove():int
   {
     $record_id = $this->{$this->primaryKey};
     return $this->delete([$this->primaryKey => $record_id]);
   }

   public function save():int
   {
     $record_id = $this->{$this->primaryKey};
     return $this->update($this->attributes,[$this->primaryKey => $record_id]);
   }
   #Create (insert)
   public function create(array $data):int
   {
   
        $this->connection->insert($this->table, $data);
        return $this->connection->id();
   }
   #Read (select) single | multiple
   public function find($id):object
   {
     $record =  $this->connection->get($this->table,'*',[$this->primaryKey => $id]);
     if(is_null($record)) return (object)null;
     
     foreach($record as $col=>$val)
     {
        $this->attributes[$col] = $val ;
     }
     return $this;
   }
   public function getAll():array
   {
     return $this->get('*',[]);
   }
   public function get( $columns  , array $where):array
   {
      $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1 ;
      $start = ($page-1)*$this->pageSize;
      $where['LIMIT'] = [$start,$this->pageSize];
      return $this->connection->select($this->table,$columns,$where);
   }
   #Update records
   public function update(array $data  , array $where): int
   {
     $result = $this->connection->update($this->table,$data,$where);
     return $result->rowCount();
   }
   #Delete
   public function delete(array $where):int
   {
    $result = $this->connection->delete($this->table,$where);
    return $result->rowCount();
   }

    #Count
    public function count(array $where): int
    {
     return $this->connection->count($this->table,$where);
    }
}


