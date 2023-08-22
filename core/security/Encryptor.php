<?php
/**
 * Password encryptor:
 * This is a collection of functions to encrypt password
*/

class Encryptor {

    private const cost = 11; // ! Algorithm encryption cost (encryption iteration strength)

    public static function encryptPassword(string $password): string{
        return password_hash($password, PASSWORD_DEFAULT, ["cost" => Encryptor::cost]);
    }
    
    public static function comparePassword(string $literal_password, string $encrypted_password) : bool {        
        return password_verify ($literal_password, $encrypted_password);
    }

}
