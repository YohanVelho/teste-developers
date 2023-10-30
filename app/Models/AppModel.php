<?php

namespace App\Models;

class AppModel
{

    public function __construct(
        public $db
    )
    {
    }

    public function insertQuery($table, $values)
    {
        $columns = array_keys($values);

        foreach ($values as $column => $value) {
            $values[":$column"] = $value;
            unset($values[$column]);
        }

        $inserir = $this->db->prepare('
            INSERT INTO ' . $table . ' 
                (' . implode(',', $columns) . ')
            VALUES 
                (' . implode(',', array_keys($values)) . ')
        ');

        $inserir->execute($values);

        if($this->db->lastInsertId()){
            return 'Cadastrado com sucesso!';
        }else{
            return 'Erro no cadastro!';
        }
    }

    public function updateQuery($table, $values, $wheres)
    {
        $data = [];

        $columns_equals = [];

        foreach ($values as $column => $value) {
            $columns_equals[] = "$column = :$column";
            $data[":$column"] = $value;
        }

        $equals_wheres = [];

        foreach ($wheres as $column => $value) {
            $equals_wheres[] = "$column = :{$column}_W";
            $data[":{$column}_W"] = $value;
        }

        $editar = $this->db->prepare('
			UPDATE ' . $table . ' SET 
				' . implode(',', $columns_equals) . '
			WHERE ' . implode(' AND ', $equals_wheres) . '
		');

        $editar->execute($data);

        if($editar->rowCount()){
            return 'Editado com sucesso!';
        }else{
            return 'Erro ao editar!';
        }
    }

    public function deleteQuery($table, $wheres)
    {
        $values_equals = [];
        $values = [];

        foreach ($wheres as $column => $value) {

            if (!is_array($value)) {
                $values_equals[] = " $column = :$column ";
                $values[":$column"] = $value;
            } else {
                $in = [];
                $z = 1;

                foreach ($value as $sub_value) {
                    $in[] = ":$column$z";
                    $values[":$column$z"] = $sub_value;
                    $z++;
                }

                $values_equals[] = " $column IN (" . implode(',', $in) . ") ";
            }
        }

        $delete = $this->db->prepare('
			DELETE FROM ' . $table . ' WHERE ' . implode(' AND ', $values_equals) . '
		');
        $delete->execute($values);

        return $delete->rowCount();
    }
}
