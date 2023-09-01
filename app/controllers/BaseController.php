<?php

// This class is the base of all of the controllers (common actions)
class BaseController{

    public function __construct(){}

    /**
     * This function returns an specific view based on the $name_view and exports the $params that the view uses, of course
     * if the view requiered it, else, $params is an empty array by default
     * @param string $name_view is the name of the view to return (without extension of the file and it's view.php)
     * @param array $params is the array that contains the data to show on the view via extract
    */
    protected static function returnView(string $name_view, Array $params = []){
        
        if(file_exists("./public/views/{$name_view}.view.php")){
            extract($params);
            return require "./public/views/{$name_view}.view.php";
        }else{
            header("HTTP/1.1 404 NOT FOUND");
        }
    }
    
    /**
     * This function redirect to an specific resource past on the $route, it'll registered on the routes of the app
     * or use validate headers by the PHP how to response (example 404, 500, etc.)
     * @param string $route is the name of the resource/route to send to the app
    */
    protected static function redirect(string $route) : void {
        header("Location: /{$route}");
    }
}