<?php 

namespace App\Models;

use App\Connection;

class AppModel {

    protected $db;

    protected function __construct()
    {  
        $this->db = Connection::getDb();
    }
}

?>