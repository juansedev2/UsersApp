<?php

// This class is the base of all of the controllers (common actions)
class BaseController{

    public function __construct(){}

    protected static function returnView(string $name_view): void{
        
        if(file_exists("./public/views/{$name_view}.view.php")){
            require "./public/views/{$name_view}.view.php";
        }else{
            header("HTTP/1.0 404 NO ENCONTRADO");
        }
    }

    protected static function redirect(string $route) : void {
        header("Location: /{$route}");
    }
}