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
     * ROLES is an associative array that must contains the names of the validate roles in the app 
    */
    private const ROLES = [1 => "administrador", 2 => "general"];
    /**
     * ROLES_VIEES is an associative array that must contains the id of each role of the app to control
     * the views that the user look in his session
    */
    private const ROLE_VIEWS = [1 => "Administrator", 2 => "General"];


    /**
     * This function returns the login view to give the credentiales of the client
    */
    public function showLogin(): void{
        static::returnView("Login");
    }

    /**
     * This function get the credentials of the user, validate each one and try login if it's possible,
     * if the user is on the database and both of credentiales (email and passowrd) and correct, then
     * he can sign in and see the correspondent view, else then a specific error message must be showed and returns the login view
    */
    public function tryLogin(): void{
        
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

    /**
     * This function return the correspondent view of the user according to his role, recovered from the
     * data of the session. If some reason the role of the user is not in the validate list, then show a error
     * for security
    */
    public function showMenu(): void{
        
        if(Authenticator::validateSession()){
            self::returnView(self::ROLE_VIEWS[$_SESSION["role_id"]]);
        }else{
            Authenticator::returnSessionError();
            $this->showLogin();
        }
    }

    /**
     * This function calls the Authenticator to close the session and returns the login view, then the
     * user shouldn't to access to the actions of his user, he needs to login again
    */
    public function closeSession(): void{
        Authenticator::deleteSession();
        $this->showLogin();
    }
}