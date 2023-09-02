<?php

/**
 * This class is the user controller to do the actions with all of the users in the app
*/
class UserController extends BaseController{

    private static string $message_operation = "";
    private static bool $alert_message = false;

    private const ROLE_PROFILE_VIEWS = [1 => "AdministratorProfile", 2 => "GeneralProfile"];

    public function __construct(){}
    
    /**
     * This function returns the profile of the user with his data according his id (only one user), also verify
     * if the usser is log in, else return to the menu view
    */
    public function showProfile(){

        if(!$this->validateSession()){
            return $this->redirectToMenu();
        }

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

        $this->resetMessageOperation();
    }

    /**
     * This function get the data of the user profile and updates it, but this filter by the role and in this way, the 
     * update will can be different an according to the respective permission (that information one user by rol can update)
    */

    public function updateUserProfile(){

        if(!$this->validateSession()){
            return $this->redirectToMenu();
        }
        
        switch ($this->validateRol()) {
            
            case '1': // Case admin
                $name = $_POST["ssss"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                dd("Administrador");
            break;

            case '2': // Case general
                
                $email = $_POST["email"];
                $password = $_POST["password"];

                // * To show messages of errors in the data, better use the front for that porpouse, in the back, only cancel the request and return the view again

                if(!FormValidator::EmailValidator($email)){
                    return self::redirect("pefil");
                }

                if(empty($password)){ // If the passwod is empty, then real password doesn't have to change, only the email

                    $user = User::selectOne($_SESSION["id_user"]);
                    $user->update(["email" => $email]);
                    $this->sendMessageOperation("Tu correo se ha actualizado correctamente");
                    return $this->showProfile();
                }else{

                    if(!FormValidator::PasswordValidator($password)){
                        return self::redirect("pefil");
                    }

                    $user = User::selectOne($_SESSION["id_user"]);
                    dd($user);

                }

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

    private function validateSession(): bool{
        return SessionController::validateSession();
    }

    private function redirectToMenu(){
        Authenticator::returnSessionError();
        return self::redirect("login");
    }

    private function sendMessageOperation(string $message): void{
        self::$alert_message = true;
        self::$message_operation = $message;
    }

    private function resetMessageOperation(): void{
        self::$alert_message = false;
        self::$message_operation = "";
    }

    public static function isthereAlert(): bool {
        return self::$alert_message;
    }

    public static function getAlert(): string {
        return self::$message_operation;
    }


}