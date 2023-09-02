<?php

/**
 * This class is the user controller to do the actions with all of the users in the app
*/
class UserController extends BaseController{

    private static string $message_operation = "";
    private static bool $alert_message = false;

    private const ROLE_PROFILE_VIEWS = [1 => "AdministratorProfile", 2 => "GeneralProfile"];

    public function __construct(){}

    public function showProfile(){

        Authenticator::startSession();
        // Need to query of the user according his id user of the session
        $user = User::selectOne($_SESSION["id_user"]);
        $name_view = Self::ROLE_PROFILE_VIEWS[$this->validateRol()];
        // It's necessary send the roles on the db to don't insert manually
        $identification_types = (new IdentificationType)->selectAll();
        // Also match the id of the identification type and it's name
        $user->addTypeIdentificationName($identification_types);
        
        if(isset($name_view)){ // In case of error, validate it
            $this->returnView($name_view, [
                "user" => $user->properties,
                "identification_types" => $identification_types
            ]);
        }else{
            $this->redirect("404");
        }
    }

    public function updateUserProfile(){
        
        switch ($this->validateRol()) {
            
            case '1': // Case admin
                $email = $_POST["email"];
                $password = $_POST["password"];
                dd("Administrador");
            break;

            case '2': // Case general
                $email = $_POST["email"];
                $password = $_POST["password"];
            break;

            default:
                $this->showProfile();
            break;

        }
    }

    private function validateRol(){
        Authenticator::startSession();
        return $_SESSION["role_id"];
    }

}