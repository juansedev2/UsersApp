<?php

// This class is the router of the request in the app by the client
class Router{

    public function __construct(private array $routes){}

    public function treatRequest(string $url)
    {

        if (array_key_exists($url, $this->routes)) {

            $controller = $this->routes["url"][0];
            $method = $this->routes["url"][1];

            if(!class_exists($controller)){
                throw new Exception("CONTROLADOR {$controller} NO EXISTE", 1);
            }else if(!method_exists($controller, $method)){
                throw new Exception("CONTROLADOR {$controller} NO EXISTE", 1);
            }else{
                return (new $controller)->$method;
            }
            
        }

        // Maybe it's possible return a 404 view or a header with 404
        throw new Exception("ERROR, RECURSO NO ENCONTRADO", 1);
    }
}
