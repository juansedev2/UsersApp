<?php

// This class is the handler of the request of the clieny by the URL
class Handler{

    /**
     * ! This function maybe can change if the enviroment is a server with configuration for friendly routew
     * ! with files how .htaccess for example, in that case is necessary work with the name of the param of url petition
     * ! acoording to the configuration
     * !
    */
    // Return the URL of the request
    public static function getURL() : string {
        return trim($_SERVER["REQUEST_URI"], "/");
    }

    /* For example this function wait for a param called url that is defined in the file of configuration of the server
    public static function obtenerUrl() : string{
        return trim($_GET["url"], "/");
    }
    */

}