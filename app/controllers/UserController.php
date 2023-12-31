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
            return $this->redirectToLogin();
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
            return $this->redirectToLogin();
        }
        
        switch ($this->validateRol()) {
            
            case '1': // Case admin

                $first_name = $_POST["first_name"];
                $middle_name = $_POST["middle_name"];
                $last_name = $_POST["last_name"];
                $age = $_POST["age"];
                $identification_type = $_POST["identification_type"];
                $email = $_POST["email"];
                $identification_number = $_POST["identification_number"];
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

                if(empty($identification_type) or !is_numeric($identification_type)){
                    $this->sendMessageOperation("Tipo de documento no válido");
                    return $this->showProfile();
                }

                if(empty($identification_number) or !is_numeric($identification_number)){
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
                        "identification_type" => $identification_type,
                        "identification_number" => $identification_number,
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
                        "identification_type" => $identification_type,
                        "identification_number" => $identification_number,
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

    public function showUserManager(){

        Authenticator::startSession();

        if(!$this->validateSession()){
            return $this->redirectToLogin();
        }

        if($_SESSION["role_id"] != "1"){
            return StaticController::returnView("403");
        }

        $users = (new User)->selectAll();

        // If the user is no the super admin, then he cannot view that super user to edit it
        if($_SESSION["id_user"] != 1){
            array_shift($users);
        }
        
        $this->returnView("UserManager", [
            "users" => $users
        ]);

    }

    public function showcreateUser(){

        if(!$this->validateSession()){
            return $this->redirectToLogin();
        }

        $identification_types = (new IdentificationType)->selectAll();
        $role_list = (new Role)->selectAll();
        
        if(!$identification_types or !$role_list){
            return $this->redirect("500");
        }

        $this->returnView("CreateUser", [
            "identification_types" => $identification_types,
            "role_list" => $role_list
        ]);
    }

    public function createUser(){

        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $age = $_POST["age"];
        $role = $_POST["role"];
        $identification_type = $_POST["identification_type"];
        $email = $_POST["email"];
        $identification_number = $_POST["identification_number"];
        $password = $_POST["password"];
        $r_password = $_POST["r-password"];

        // Minimum the user should have his first name and the last name
        if(empty($first_name) or empty($last_name)){
            $this->sendMessageOperation("Nombres y/o apellidos incompletos");
            return $this->showcreateUser();
        }

        if(!FormValidator::EmailValidator($email)){
            $this->sendMessageOperation("Formato de correo electrónico no válido");
            return $this->showcreateUser();
        }

        if(empty($age) or $age > 200){
            $this->sendMessageOperation("Edad vacía o formato incorrecto");
            return $this->showcreateUser();
        }

        if(empty($role) or $role > 100 or !is_numeric($role)){
            $this->sendMessageOperation("ROL NO VÁLIDO");
            return $this->showcreateUser();
        }

        if(empty($identification_type) or !is_numeric($identification_type)){
            $this->sendMessageOperation("Tipo de documento no válido");
            return $this->showcreateUser();
        }

        if(empty($identification_number) or !is_numeric($identification_number)){
            $this->sendMessageOperation("El número de documento no puede ser vacio");
            return $this->showcreateUser();
        }

        if(!FormValidator::EmailValidator($email)){
            $this->sendMessageOperation("Formato de correo electrónico no válido");
            return $this->showcreateUser();
        }else if((new User)->queryUserByEmail($email)){
            // Also its necessary to valiate that these email doesn't exist on the system (repeated)
            $this->sendMessageOperation("Esa dirección de correo electrónico ya está en uso");
            return $this->showcreateUser();
        }

        if(!FormValidator::PasswordValidator($password)){
            $this->sendMessageOperation("La contraseña debe contener mayúsculas minúsculas, números y caracteres especiales, mínimo 8 caracteres");
            return $this->showcreateUser();
        }

        if($password !== $r_password){
            $this->sendMessageOperation("Las contraseñas no coinciden");
            return $this->showcreateUser();
        }

        // Then all of the data is filled, create the new user
        if(empty($middle_name)){
            $middle_name = null;
        }

        $result = User::create([
            "first_name" => $first_name,
            "middle_name" => $middle_name,
            "last_name" => $last_name,
            "age" => $age,
            "role_id" => $role,
            "identification_type" => $identification_type,
            "email" => $email,
            "identification_number" => $identification_number,
            "password" => Encryptor::encryptPassword($password)
        ]);

        if($result){
            $this->sendMessageOperation("El usuario {$first_name} {$middle_name} - {$email} ha sido creado exitósamente");   
        }else{
            $this->sendMessageOperation("Hubo un error al momento de crear el usuario, inténtalo de nuevo o comunícate con soporte");   
        }
        return $this->showcreateUser();

    }

    public function showQueryUser(){

        $this->validatePermission();
        
        $id = $_POST["id_user"];
        $user = User::selectOne($id);
            
        if($user){

            $identification_types = (new IdentificationType)->selectAll();
            $role_list = (new Role)->selectAll();
            $user->addTypeIdentificationName($identification_types);
            $user->addTypeOfRole($role_list);
            //dd($role_list);
            
            return $this->returnView(
                "FullProfileUser",
                [
                    "user" => $user->properties,
                    "identification_types" => $identification_types,
                    "role_list" => $role_list
                ]
            );
        }else{
            return $this->redirect("500");
        }
    }

    public function showEditUser(){

        $this->validatePermission();
        
        $id = $_POST["id_user"];
        $user = User::selectOne($id);
            
        if($user){

            $identification_types = (new IdentificationType)->selectAll();
            $role_list = (new Role)->selectAll();
            $user->addTypeIdentificationName($identification_types);
            $user->addTypeOfRole($role_list);
            
            return $this->returnView(
                "FullProfileUserEdit",
                [
                    "user" => $user->properties,
                    "identification_types" => $identification_types,
                    "role_list" => $role_list
                ]
            );

        }else{
            return $this->redirect("500");
        }
    }

    public function editUser(){

        $this->validatePermission();

        $id_user = $_POST["id_user"];
        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $age = $_POST["age"];
        $role = $_POST["role_id"];
        $identification_type = $_POST["identification_type"];
        $email = $_POST["email"];
        $identification_number = $_POST["identification_number"];
        $password = $_POST["password"];
        $r_password = $_POST["r-password"];

        if(empty($id_user)){
            $this->sendMessageOperation("Un error en la actualización, por favor intentar más tarde..");
            return $this->showEditUser();
        }

        if(empty($first_name) or empty($last_name)){
            $this->sendMessageOperation("Nombres y/o apellidos incompletos");
            return $this->showEditUser();
        }

        if(!FormValidator::EmailValidator($email)){
            $this->sendMessageOperation("Formato de correo electrónico no válido");
            return $this->showEditUser();
        }

        if(empty($age) or $age > 200){
            $this->sendMessageOperation("Edad vacía o formato incorrecto");
            return $this->showEditUser();
        }

        if(empty($role) or $role > 100 or !is_numeric($role)){
            $this->sendMessageOperation("ROL NO VÁLIDO");
            return $this->showEditUser();
        }

        if(empty($identification_type) or !is_numeric($identification_type)){
            $this->sendMessageOperation("Tipo de documento no válido");
            return $this->showcreateUser();
        }

        if(empty($identification_number) or !is_numeric($identification_number)){
            $this->sendMessageOperation("El número de documento no puede ser vacio");
            return $this->showEditUser();
        }

        if(!FormValidator::EmailValidator($email)){
            $this->sendMessageOperation("Formato de correo electrónico no válido");
            return $this->showEditUser();
        }

        // Then all of the data is filled, create the new user
        if(empty($middle_name)){
            $middle_name = null;
        }

        $user = User::selectOne($id_user);
        $result = null;

        if(empty($password)){

            $result = $user->update([
                "first_name" => $first_name,
                "middle_name" => $middle_name,
                "last_name" => $last_name,
                "age" => $age,
                "role_id" => $role,
                "identification_type" => $identification_type,
                "email" => $email,
                "identification_number" => $identification_number,
            ]);

        }else{

            if(!FormValidator::PasswordValidator($password)){
                $this->sendMessageOperation("La contraseña debe contener mayúsculas minúsculas, números y caracteres especiales, mínimo 8 caracteres");
                return $this->showEditUser();
            }

            if($password !== $r_password){
                $this->sendMessageOperation("Las contraseñas no coinciden");
                return $this->showEditUser();
            }
            
            $result = $user->update([
                "first_name" => $first_name,
                "middle_name" => $middle_name,
                "last_name" => $last_name,
                "age" => $age,
                "role_id" => $role,
                "identification_type" => $identification_type,
                "email" => $email,
                "identification_number" => $identification_number,
                "password" => Encryptor::encryptPassword($password)
            ]);
        }

        if($result){
            $this->sendMessageOperation("El usuario se ha actulizado correctamente");   
        }else{
            $this->sendMessageOperation("Hubo un error al momento de actualizar el usuario, inténtalo de nuevo o comunícate con soporte");   
        }
        return $this->showEditUser();
        
    }

    public function deleteUser(){

        $this->validatePermission();
        
        $id = $_POST["id_user"];
        $user = User::selectOne($id);
        $result = $user->delete();

        return $this->showUserManager();

    }


    private function validateRol(){
        Authenticator::startSession();
        return $_SESSION["role_id"];
    }

    private function validateSession(): bool{
        return SessionController::validateSession();
    }

    private function redirectToLogin(){
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

    private function validatePermission(){
        
        Authenticator::startSession();

        if(!$this->validateSession()){
            return $this->redirectToLogin();
        }

        if($_SESSION["role_id"] != "1"){
            return StaticController::returnView("403");
        }
    }
}