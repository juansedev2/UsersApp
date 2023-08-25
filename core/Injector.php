<?php

// This class should store and provide dependencies that other clases may need
class Injector{

    /**
     * @param array $dependencies
     * This param is for the attribiute to define the dependencies of the object to store and provide
    */

    protected static Array $dependencies;

    public function __construct(){}

    /**
     * @param string $dependency_name The name of the dependecy
     * @param mixed $value The value of the dependency (object, variable, etc.)
     * This function store the dependency
    */
    public static function set(string $dependency_name, mixed $value){
        static::$dependencies[$dependency_name] = $value;
    }

    /**
     * @param string $dependency_name The name of the dependecy to return
     * This function returns the dependency
    */
    public static function get(string $dependency_name){
        if(array_key_exists($dependency_name, static::$dependencies)){
            return static::$dependencies[$dependency_name];
        }
    }

}