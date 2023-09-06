<?php

class Role extends Model{

    /**
     * Please look the parent class (Model) to know about this attributes and the constructor
    */
    protected static string $table_name = "roles";
    protected static string $primary_key = "id";

    public function __construct(Array $properties = []){
        parent::__construct($properties);
    }

}