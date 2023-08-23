<?php

class SessionController extends BaseController{
    
    public function showLogin(){
        static::returnView("Login");
    }

    public function tryLogin(){
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Call the model User to query for the user and validate it's personal data
        $user = new User();

        if($user->queryUserByEmail($email, $password)){
            dd("Pasó");
        }else{
            Authenticator::$alert_credentials = true;
            $this->showLogin();
        }
    }
}