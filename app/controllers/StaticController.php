<?php

// This class must returns all of the static views, without database o data resources interaction
class StaticController extends BaseController{

    public function __construct(){}

    public function showLanding(){
        static::returnView("Landing");
    }

}