<?php

/**
 * This class represents the model of the types of the identifications in the system
*/
class IdentificationType extends Model{

    /**
     * Please look the parent class (Model) to know about this attributes and the constructor
    */
    protected static string $table_name = "type_identifications";
    protected static string $primary_key = "id";

    public function __construct(Array $properties = []){
        parent::__construct($properties);
    }

}