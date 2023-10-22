<?php 

namespace App;

class Connection {

    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }
    
    public static function getDb(){
        try {
            $connect = new \PDO(
                'mysql:host=localhost;dbname=teste_developers;charset=utf8',
                'root',
                ""
            );
            return $connect;
        } catch (\PDOException $e) {
            //throw $th;
        }
    }
}