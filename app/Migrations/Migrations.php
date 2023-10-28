<?php

namespace App\Migrations;

class Migrations{

    public function __construct() {
        $host = "localhost";
        $root = "root";
        $root_password = "";
        $db = "teste_developers_";
        
        try {
            $con = new \PDO("mysql:host=$host", $root, $root_password);
        
            $con->exec("CREATE DATABASE IF NOT EXISTS `$db`;

            USE `$db`;

            CREATE TABLE IF NOT EXISTS categories (
                `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
                `active` TINYINT(1) DEFAULT 1,
                `name` VARCHAR(190) NULL,
                `created` DATETIME NULL,
                `modified` DATETIME NULL);

            CREATE TABLE IF NOT EXISTS products (
                `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
                `active` TINYINT(1) DEFAULT 1,
                `code` VARCHAR(190) NULL,
                `name` VARCHAR(190) NULL,
                `price` DECIMAL(10,2) NULL,
                `category_id` BIGINT NULL,
                `created` DATETIME NULL,
                `modified` DATETIME NULL,
                FOREIGN KEY (category_id) REFERENCES categories(id));
            ") or die(print_r($con->errorInfo(), true));
            
        } catch (\PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}


