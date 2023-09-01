<?php

// This class is the router of the request in the app by the client
class Router{

    /**
     * @param array $routes Is the param to define the routes of the app
    */
    public function __construct(private array $routes){}

    /**
     *@param string $url Is the for manage the request of the client
     This function analyze the url and return the corresponding action
    */
    public function treatRequest(string $url){

        if (array_key_exists($url, $this->routes)) {

            $controller = $this->routes["$url"][0];
            $method = $this->routes["$url"][1];

            if(!class_exists($controller)){
                throw new Exception("CONTROLADOR {$controller} NO EXISTE", 1);
            }else if(!method_exists($controller, $method)){
                throw new Exception("CONTROLADOR {$controller} y su método {$method} NO EXISTE", 1);
            }else{
                return (new $controller)->$method();
            }
            
        }
        // This is for development
        //throw new Exception("ERROR, RECURSO NO ENCONTRADO", 1);
        $staticController = new StaticController();
        $staticController->show404();
    }
}
