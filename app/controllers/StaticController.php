<?php

// This class must returns all of the static views, without database o data resources interaction
class StaticController extends BaseController{

    public function __construct(){}

    public function showLanding(){
        static::returnView("Landing");
    }

    public function showRegister(){
        static::returnView("Register");
    }

    public function showAbout(){
        static::returnView("About");
    }

    public function show404(){
        static::returnView("404");
    }

    public function show403(){
        static::returnView("403");
    }

    /**
     * This function returns a view about an error of the server, this is used in cases for example the server cannot answer the request
     * for a fatal error, for example the connection with the db it got lost
    */
    public function showInternalServerError(){
        static::returnView("500");
    }


}