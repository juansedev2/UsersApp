<?php

class SessionController extends BaseController{
    
    public function showLogin(){
        static::returnView("Login");
    }

    public function validateLogin(){
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        //dd("Email: {$email} and password: {$password}");

        // Call the helper authenticator
    }
}