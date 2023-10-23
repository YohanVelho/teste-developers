<?php 

namespace App;

class Connection {

    public static function getDb(){
        try {
            $connect = new \PDO(
                'mysql:host=192.168.10.201;dbname=teste_yohan;charset=utf8',
                'desenvolvimento',
                ""
            );
            return $connect;
        } catch (\PDOException $e) {
            //throw $th;
        }
    }
}