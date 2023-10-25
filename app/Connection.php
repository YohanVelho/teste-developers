<?php 

namespace App;

class Connection {

    public static function getDb(){
        try {
            $connect = new \PDO(
                'mysql:host=127.0.0.1;dbname=teste_developers;charset=utf8',
                'root',
                ""
            );
            return $connect;
        } catch (\PDOException $e) {
            //throw $th;
        }
    }
}