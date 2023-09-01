<?php

// This class is the representation of the users in the system
class User extends Model{

    /**
     * Please look the parent class (Model) to know about this attributes and the constructor
    */
    protected static string $table_name = "users";
    protected static string $primary_key = "id";

    public function __construct(Array $properties = []){
        parent::__construct($properties);
    }

    /**
     * @param string $email_user is the email of the user to query in the db
     * @return bool | array false if the query doesn't find any user to the email, array with it's data in otherwise
    */
    public function queryUserByEmail(string $email_user) : bool | Array{
        
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $result = Injector::get("QueryBuilder")->ownQuery($query, [$email_user]);

        if(empty($result)){
            return false;
        }else{
            return $result[0];
        }
    }

    /**
     * ? Maybe this is not the better way, maybe one query with the method join and get the data most completely how this case
     * ? with an record that needed data of two o more tables. I do this for a faster process.
     * 
     * This function add the name of the identification name according to the id of this, it's necessary
     * only if the model need it
    */
    public function addTypeIdentificationName(){
        // Add manually the name of the types
        $types_identification = ["CC - Cédula de ciudadanía", "TI - Tarjeta de identidad"];
        if($this->properties["identification_type"] < 1){
            $this->properties["identification_name"] = "ERROR DE REGISTRO";
        }else{
            $this->properties["identification_name"] = $types_identification[$this->properties["identification_type"] - 1];
        }
    }


}