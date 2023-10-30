<?php 

namespace App\Models;

use App\Models\AppModel;

class Products extends AppModel{
    
    public function getProducts(){
        return $this->db->query('SELECT * FROM products');
    }
    
    public function insertEditProduct(array $data = []){

        $data = [
            'id' => isset($data['id']) ? $data['id'] : null,
            'code' => $data['code'],
            'name' => $data['name'],
            'value' => $data['value'],
            'created' => dataToInsertDate(date('Y-m-d')),
            'modified' => dataToInsertDate(date('Y-m-d')),
        ];

        if($data['id']){
            return $this->updateQuery('products', $data, $this->db);
        }else{
            return $this->insertQuery('products', $data, $this->db);
        }
    }

    public function getProductById($id){
        $query = $this->db->prepare("SELECT * FROM products WHERE id = :id");

        $query->execute([
            ':id' => $id
        ]);

        return $query->fetch();
    }
}