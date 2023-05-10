<?php
// require __DIR__ . '/PDO.php';

class BaseModel
{
    private $table;
    private $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->connectPDO();
    }

    public function create($dataCreate)
    { 
        try {
            $column = array_keys($dataCreate);
            
            $keyMap = array_map(function($item) {
                return ":" . $item;
            }, $column);

            // $keyMap = array_map(function($item) {
            //     return "'" . $item . "'";
            // }, array_values($dataCreate));

            $sql = "INSERT INTO $this->table (" . implode(', ', $column) . ") VALUES (" . implode(', ', $keyMap) . ") ";
   
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($dataCreate); 
            $id = $this->pdo->lastInsertId();

            if($id){
                echo 'ok';
            } else {
                echo $this->pdo->errorInfo();
            }
        } catch (\PDOException $e) {  
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function connectPDO()
    {
        $host = '127.0.0.1';
        $db   = 'buoi3';
        $user = 'root';
        $pass = 'root';
        $port = "3306";
        $charset = 'utf8mb4';
    
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

        try {
            $this->pdo = new \PDO($dsn, $user, $pass);
        } catch (\PDOException $e) { 
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
