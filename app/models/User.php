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


}