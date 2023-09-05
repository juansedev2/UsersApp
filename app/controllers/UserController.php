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

        if(!$user){
            return $this->redirect("500");
        }
        
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

                $first_name = $_POST["first_name"];
                $middle_name = $_POST["second_name"];
                $last_name = $_POST["last_name"];
                $age = $_POST["age"];
                $document_type = $_POST["document_type"];
                $email = $_POST["email"];
                $document_number = $_POST["document_number"];
                $password = $_POST["password"];

                if(empty($first_name) or empty($middle_name) or empty($last_name)){
                    $this->sendMessageOperation("Nombres y/o apellidos incompletos");
                    return $this->showProfile();
                }

                if(!FormValidator::EmailValidator($email)){
                    $this->sendMessageOperation("Formato de correo electrónico no válido");
                    return $this->showProfile();
                }

                if(empty($age) or $age > 200){
                    $this->sendMessageOperation("Edad vacía o formato incorrecto");
                    return $this->showProfile();
                }

                if(empty($document_type) or !is_numeric($document_type)){
                    $this->sendMessageOperation("Tipo de documento no válido");
                    return $this->showProfile();
                }

                if(empty($document_number) or !is_numeric($document_type)){
                    $this->sendMessageOperation("El número de documento no puede ser vacio");
                    return $this->showProfile();
                }

                if(!FormValidator::EmailValidator($email)){
                    $this->sendMessageOperation("Formato de correo electrónico no válido");
                    return $this->showProfile();
                }

                // In the case of the admin, he can update all of his information

                if(empty($password)){ // If the passwod is empty, then real password doesn't have to change, only the email

                    $user = User::selectOne($_SESSION["id_user"]);
                    $result = $user->update([
                        "first_name" => $first_name,
                        "middle_name" => $middle_name,
                        "last_name" => $last_name,
                        "age" => $age,
                        "email" => $email,
                        "identification_type" => $document_type,
                        "identification_number" => $document_number,
                    ]);
                    
                    if($result){
                        $this->sendMessageOperation("Tu información se ha actualizado correctamente");
                    }else{
                        $this->sendMessageOperation("Hubo un error al intentar actualizar la información, por favor inténtalo de nuevo o más tarde");
                    }

                    return $this->showProfile();

                }else{

                    if(!FormValidator::PasswordValidator($password)){
                        $this->sendMessageOperation("La contraseña debe contener mayúsculas minúsculas, números y caracteres especiales, mínimo 8 caracteres");
                        return $this->showProfile();
                    }

                    $user = User::selectOne($_SESSION["id_user"]);
                    $result = $user->update([
                        "first_name" => $first_name,
                        "middle_name" => $middle_name,
                        "last_name" => $last_name,
                        "age" => $age,
                        "email" => $email,
                        "identification_type" => $document_type,
                        "identification_number" => $document_number,
                        "password" => Encryptor::encryptPassword($password)
                    ]);

                    if($result){
                        $this->sendMessageOperation("Tu información se ha actualizado correctamente");
                    }else{
                        $this->sendMessageOperation("Hubo un error al intentar actualizar la información, por favor inténtalo de nuevo o más tarde");
                    }
                    $this->showProfile();

                }
                
            break;

            case '2': // Case general
                
                $email = $_POST["email"];
                $password = $_POST["password"];

                // * To show messages of errors in the data, better use the front for that porpouse, in the back, only cancel the request and return the view again

                if(!FormValidator::EmailValidator($email)){
                    $this->sendMessageOperation("Formato de correo electrónico no válido");
                    return $this->showProfile();
                }

                // TODO: MANEJAR LOS ERRORES DE LAS OPERACIONES CON LA BD, RETORNAR VISTA ERROR 500 SI LAS OPERACIONES DEVUELVEN FALSO

                if(empty($password)){ // If the passwod is empty, then real password doesn't have to change, only the email

                    $user = User::selectOne($_SESSION["id_user"]);
                    $result =$user->update([
                        "email" => $email
                    ]);
                    
                    if($result){
                        $this->sendMessageOperation("Tu correo se ha actualizado correctamente");
                    }else{
                        $this->sendMessageOperation("Hubo un error al intentar actualizar el correo, por favor inténtalo de nuevo o más tarde");
                    }

                    return $this->showProfile();

                }else{

                    if(!FormValidator::PasswordValidator($password)){
                        $this->sendMessageOperation("La contraseña debe contener mayúsculas minúsculas, números y caracteres especiales, mínimo 8 caracteres");
                        return $this->showProfile();
                    }

                    $user = User::selectOne($_SESSION["id_user"]);
                    $result = $user->update([
                        "email" => $email,
                        "password" => Encryptor::encryptPassword($password)
                    ]);

                    if($result){
                        $this->sendMessageOperation("Tu correo y contraseña se han actualizado correctamente");
                    }else{
                        $this->sendMessageOperation("Hubo un error al intentar actualizar los datos, por favor inténtalo de nuevo o más tarde");
                    }

                    $this->showProfile();

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