<?php 

namespace App\Models;

use App\Connection;

class AppModel {

    public $db;

    public function __construct()
    {  
        $con = new Connection();
        $this->db = $con::getDb();
    }

    public function insertQuery($table, $values){
        $columns = array_keys($values);
        
        foreach($values as $column => $value){
            $values[":$column"] = $value;
            unset($values[$column]);
        }
        
        $inserir = $this->db->prepare('
            INSERT INTO '.$table.' 
                ('.implode(',', $columns).')
            VALUES 
                ('.implode(',', array_keys($values)).')
        ');
        
        $inserir->execute($values);
        
        return $this->db->lastInsertId();
    }
}

?>