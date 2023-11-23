<?php

namespace Database;

use PDO;
use PDOException;


class Database{
    
    private $servername = 'localhost';
    private $dbusername = 'root';
    private $dbname = 'php_project';
    private $dbpassword = '';
    private $options;
    private $connection;
    function __construct()
    {
        
        try{
            // $this->options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "There is something wrong with connection :". $e->getMessage();
            return false;
        }
    }

    public function select($query, $values = null){
        try{
            if($values){
                $stmt = $this->connection->prepare($query);
                $stmt->execute($values);
                $result = $stmt;
                return $result;
            }
            else{
                $stmt = $this->connection->query($query);
                return $stmt;
            }
        }
        catch(PDOException $e){
            echo "Something went wrong :". $e->getMessage();
        }
    }

    public function insert($tableName, $fields, $values){
        try{
            
            $sql = "INSERT INTO ".$tableName." (". implode(', ', $fields) . " , created_at) VALUES ( :". implode(', :', $fields) . " , now())";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_combine($fields, $values));
            return true;
        }
        catch(PDOException $e){
            echo "Something went wrong :". $e->getMessage();
            return false;
        }
    }

    public function update($tableName, $id, $fields, $values){
        
        $sql = "UPDATE ". $tableName . " SET";
        foreach($values as $field=>$value){
            if($value != null){
                $sql .= " `" .$field . "` = ?,";
            }
            else{
                $sql .= " `" .$field . "` = null,";
            }
        }

        $sql .= " updated_at = now() WHERE id = ?";
        try{
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
        }
        catch(PDOException $e){
            echo "Something went wrong :". $e->getMessage();
        }
    }

    public function delete($tableName, $id){
        try{
            $sql = 'DELETE FROM ' . $tableName . ' WHERE id = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($id); 
        }
        catch(PDOException $e){
            echo "Something went wrong :". $e->getMessage();
        }
    }

    function createTable($query){
        
        try{
            
            return $this->connection->exec($query);
            
        }
        catch(PDOException $e){
            echo "Something went wrong :". $e->getMessage();
            return false;
        }
    }
    
}



