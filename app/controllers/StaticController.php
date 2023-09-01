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


}