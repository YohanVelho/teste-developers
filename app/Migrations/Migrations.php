<?php

namespace App\Migrations;

use App\Connection;

class Migrations extends Connection{

    public function __construct() {
        
        $data = $this->getDbInfo();

        $host = $data['host'];
        $root = $data['root'];
        $root_password = $data['root_password'];
        $db = $data['db'];

        try {
            $con = new \PDO("mysql:host=$host", $root, $root_password);
        
            $con->exec("CREATE DATABASE IF NOT EXISTS `$db`;

            USE `$db`;

            CREATE TABLE IF NOT EXISTS categories (
                `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(190) NULL,
                `created` DATETIME NULL,
                `modified` DATETIME NULL);

            CREATE TABLE IF NOT EXISTS products (
                `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
                `code` VARCHAR(190) NULL,
                `name` VARCHAR(190) NULL,
                `value` DECIMAL(10,2) NULL,
                `category_id` BIGINT NULL,
                `created` DATETIME NULL,
                `modified` DATETIME NULL,
                FOREIGN KEY (category_id) REFERENCES categories(id));
            ");
            
        } catch (\PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}


