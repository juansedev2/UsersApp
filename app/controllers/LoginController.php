<?php

class LoginController extends BaseController{
    
    public function showLogin(){
        static::returnView("Login");
    }
}