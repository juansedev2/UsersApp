<?php

/**
 * This class contains validations functions for forms
*/
class FormValidator{

    public static function EmailValidator(string $email): bool{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }
    }

    public static function PasswordValidator(string $password): bool{
        $regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        return preg_match($regex, $password);
    }

}