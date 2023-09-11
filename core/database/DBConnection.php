<?php

/**
 *This class returns the connection of the database 
*/
class DBConecction{

    /**
     * @param array $config is the array that must contain the params of the configuration to the connection with the database 
     * This function that will try the connection with the database and return the connector with the PDO interface
    */
    public static function tryConnection(Array $config) : PDO | bool{

        try {
            $pdo= new PDO("{$config["sgbd"]}:host={$config["ip"]}:{$config["port"]};dbname={$config["name_bd"]}", "{$config["user"]}", "{$config["password"]}");
            //echo "Conexión a la base de datos exitosa";
            return $pdo;
        } catch (\PDOException $error) {
            //echo "UPS, error al intentar conectarse a la base de datos por: {$error}";
            (new StaticController)->showInternalServerError();
            return false;
        }
    }

}