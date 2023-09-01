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
        // Need to query of the user according his session
        $user = User::selectOne($_SESSION["id_user"]);
        $user->addTypeIdentificationName();
        $name_view = Self::ROLE_PROFILE_VIEWS[$this->validateRol()];
        
        if(isset($name_view)){ // In case of error, validate it
            $this->returnView($name_view, [
                "user" => $user->properties
            ]);
        }else{
            $this->redirect("404");
        }
    }

    public function updateUserProfile(){
        
        switch ($this->validateRol()) {
            case '1': // Case admin
                # code...
            break;
            case '2': // Case general
                # code...
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