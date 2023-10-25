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

    public function updateQuery($table, $values, $wheres){
		$data = [];
		
		$columns_equals = [];
		
		foreach($values as $column => $value){
			$columns_equals[] = "$column = :$column";
			$data[":$column"] = $value;
		}
		
		$equals_wheres = [];
		
		foreach($wheres as $column => $value){
			$equals_wheres[] = "$column = :{$column}_W";
			$data[":{$column}_W"] = $value;
		}
		
		$editar = $this->db->prepare('
			UPDATE '.$table.' SET 
				'.implode(',', $columns_equals).'
			WHERE '.implode(' AND ', $equals_wheres).'
		');
		
		$editar->execute($data);
		
		return $editar->rowCount();
	}
}

?>