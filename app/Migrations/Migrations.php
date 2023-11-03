<?php

namespace App\Migrations;

use App\Connection;

class Migrations{

    public function __construct() {
        $con = new Connection();
        $data = $con->getDbInfo();

        $host = $data['host'];
        $root = $data['root'];
        $root_password = $data['root_password'];
        $db = $data['db'];

        try {
            $con = new \PDO("mysql:host=$host", $root, $root_password);
        
            $con->exec("CREATE DATABASE IF NOT EXISTS `$db`;

            USE `$db`;

            CREATE TABLE IF NOT EXISTS products (
                `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
                `active` TINYINT DEFAULT 1,
                `code` VARCHAR(190) NULL,
                `category` VARCHAR(190) NULL,
                `name` VARCHAR(190) NULL,
                `value` DECIMAL(10,2) NULL,
                `created` DATETIME NULL,
                `modified` DATETIME NULL);
            ");
            
        } catch (\PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}


