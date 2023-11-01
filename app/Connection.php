<?php 

namespace App;

class Connection {

    public $host;
    public $root;
    public $root_password;
    public $db;

    public function __construct()
    {
        $this->host = "192.168.10.201";
        $this->root = "desenvolvimento";
        $this->root_password = "ellite";
        $this->db = "teste_yohan";
    }

    public function getDbInfo(){
        $data['host'] = $this->host;
        $data['root'] = $this->root;
        $data['root_password'] = $this->root_password;
        $data['db'] = $this->db;

        return $data;
    }

    public function getDb(){
        
        try {
            $connect = new \PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->root,
                $this->root_password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
                // 'mysql:host=127.0.0.1;dbname=teste_developers;charset=utf8',
                // 'root',
                // ""
            );
            return $connect;
        } catch (\PDOException $e) {
            print_r($e->getMessage(), true);
        }
    }
}