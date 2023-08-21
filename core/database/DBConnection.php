<?php

/**
 *This class returns the connection of the database 
*/
class DBConecction{

    public static function tryConnection(Array $config) : PDO | bool{

        try {
            $pdo= new PDO("{$config["sgbd"]}:host={$config["ip"]}:{$config["port"]};dbname={$config["name_bd"]}", "{$config["user"]}", "{$config["password"]}");
            echo "Conexión a la base de datos exitosa";
            return $pdo;
        } catch (\PDOException $error) {
            echo "UPS, error al intentar conectarse a la base de datos por: {$error}";
            return false;
        }
    }

}