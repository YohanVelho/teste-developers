<?php 

namespace App\Models;

use App\Connection;
use App\Models\AppModel;

class Products extends AppModel{
    
    public function getProducts(){
        return $this->db->query('SELECT * FROM products');
    }
    
    public function insertProduct($pdo, array $data = [], array $files = []){

        $data = [
            'code' => $data['code'],
            'name' => $data['name'],
            'value' => $data['value'],
            'created' => dataToInsertDate(date('Y-m-d')),
            'modified' => dataToInsertDate(date('Y-m-d')),
        ];

        return AppModel::insertQuery('products', $data, $this->db);
    }
}