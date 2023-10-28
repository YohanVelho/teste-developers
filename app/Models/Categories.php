<?php 

namespace App\Models;

use App\Connection;
use App\Models\AppModel;

class Categories extends AppModel{
    
    public function getCategories(){
        return $this->db->query('SELECT * FROM categories');
    }
    
    public function insertEditCategory(array $data = []){

        $data = [
            'id' => isset($data['id']) ? $data['id'] : null,
            'code' => $data['code'],
            'name' => $data['name'],
            'value' => $data['value'],
            'created' => dataToInsertDate(date('Y-m-d')),
            'modified' => dataToInsertDate(date('Y-m-d')),
        ];

        if($data['id']){
            return AppModel::updateQuery('categories', $data, $this->db);
        }else{
            return AppModel::insertQuery('categories', $data, $this->db);
        }
    }

    // public function getCategoryById($id){
    //     $query = $this->db->prepare("SELECT * FROM categories WHERE id = :id");

    //     $query->execute([
    //         ':id' => $id
    //     ]);

    //     return $query->fetch();
    // }
}