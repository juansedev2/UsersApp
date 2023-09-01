<?php

/**
 * This class is the user controller to do the actions with all of the users in the app
*/
class UserController extends BaseController{

    public function __construct(){}

    public function showProfile(){
        Authenticator::startSession();
        // Need to query of the user according his session
        $user = User::selectOne($_SESSION["id_user"]);
        $user->addTypeIdentificationName();
        $this->returnView("AdministratorProfile", [
            "user" => $user->properties
        ]);
    }

}