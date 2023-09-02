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
     * This function add the name of the identification name according to the id of this, it's necessary
     * only if the model need it
    */
    public function addTypeIdentificationName(Array $identification_types){

        // According to the identification_type of the object User, then match with the $identification_types to bind his values (id and name)
        if($this->properties["identification_type"] < 1){
            $this->properties["identification_name"] = "ERROR DE REGISTRO";
        }else{
            // It'll match the id of the identification_type of the user and the id of the identification_type of the table, and the add his name
            foreach ($identification_types as $identification_type) {
                if($identification_type->properties["id"] == $this->properties["identification_type"]){
                    return $this->properties["identification_name"] = $identification_type->properties["identification_name"];
                }
            }
        }
    }


}