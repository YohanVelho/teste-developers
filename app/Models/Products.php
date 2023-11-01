<?php 

namespace App\Models;

use App\Models\AppModel;

class Products extends AppModel{
    
    public function getProducts(){
        return $this->db->query('SELECT * FROM products')->fetchAll();
    }
    
    public function insertEditProduct(array $data = []){
        $data = [
            'id' => isset($data['id']) ? $data['id'] : null,
            'active' => $data['active'],
            'code' => $data['code'],
            'name' => $data['name'],
            'category' => $data['category'],
            'value' => $data['value'],
            'created' => date('Y-m-d'),
            'modified' => date('Y-m-d'),
        ];

        if($data['id']){
            return $this->updateQuery('products', $data, ['id' => $data['id']]);
        }else{
            return $this->insertQuery('products', $data);
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