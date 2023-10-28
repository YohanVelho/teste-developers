<?php

namespace App\Migrations;

class Migrations{

    private function __construct() {
        $host = "localhost";
        $root = "root";
        $root_password = "";
        $db = "teste_developers";
        
        try {
            $con = new \PDO("mysql:host=$host", $root, $root_password);
        
            $con->exec("CREATE DATABASE IF NOT EXISTS `$db`;")
                or die(print_r($con->errorInfo(), true));

            $con->exec("CREATE TABLE IF NOT EXISTS categories (
                `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(190) NULL,
                `created` DATETIME NULL,
                `modified` DATETIME NULL);
            ");

            $con->exec("CREATE TABLE IF NOT EXISTS products (
                `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
                `code` VARCHAR(190) NULL,
                `name` VARCHAR(190) NULL,
                `price` DECIMAL(10,2) NULL,
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


