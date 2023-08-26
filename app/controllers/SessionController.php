<?php

class SessionController extends BaseController{
    
    public function showLogin(){
        static::returnView("Login");
    }

    public function tryLogin(){
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Encrypt the password to compare with the 

        // Call the model User to query for the user and validate it's personal data
        $user = (new User())->queryUserByEmail($email);

        if($user){
            
            // It's necessary evaluate and compare both passwords (record and the input by the form)
            if(Encryptor::comparePassword($password, $user["password"])){
                dd("Pasó");
            }else{
                Authenticator::returnCredentialsError();
                $this->showLogin();
            }

        }else{
            Authenticator::returnUnregistredUserError();
            $this->showLogin();
        }
    }
}