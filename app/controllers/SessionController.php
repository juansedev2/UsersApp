<?php

class SessionController extends BaseController{

    /***
     * ? It's really necessary to have an array to prepare and use the roles of the app?
     * The answers is NO, this is a way to do this management this important part of the app, but NO necessary is the best,
     * of course it's better and dinamic recover the roles of the database for example for more actions, but in this case
     * it's not necessary because it's a small app to use. My recommendation is that is possible change this if it's necessary,
     * then you should recover that roles with a query and use it how you need it, accommodating to the use for it.
     * In this case i use an array, is fast
    */
    /**
     * 
    */
    private const ROLES = [1 => "administrador", 2 => "general"];
    private const ROLE_VIEWS = [1 => "Administrator", 2 => "General"];
    
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

                // It's necessary evaluate the rol name to prepare the session and the views
                if(array_key_exists($user["role_id"], self::ROLES)){ // For security, it's necessary compare the validate roles in the system
                    Authenticator::createSession($user["id"], $user["first_name"] . " " . $user["last_name"], $user["email"], $user["role_id"]);
                    self::redirect("menu");
                }else{
                    Authenticator::returnUnregistredUserError();
                    $this->showLogin();
                }

            }else{
                Authenticator::returnCredentialsError();
                $this->showLogin();
            }

        }else{
            Authenticator::returnUnregistredUserError();
            $this->showLogin();
        }
    }

    public function showMenu(){
        
        if(Authenticator::validateSession()){
            self::returnView(self::ROLE_VIEWS[$_SESSION["role_id"]]);
        }else{
            Authenticator::returnSessionError();
            $this->showLogin();
        }
    }
}