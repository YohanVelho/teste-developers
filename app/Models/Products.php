<?php 

namespace App\Models;

use App\Connection;
use App\Models\AppModel;

class Products extends AppModel{
    protected $db;

    protected function __construct()
    {  
        $this->db = Connection::getDb();
    }
    public function getProducts(){
        return $this->db->query('SELECT * FROM products');
    }
}