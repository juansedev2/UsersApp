<?php

// This class is the representation of the users in the system
class User extends Model{

    protected static string $table_name = "users";
    protected static string $primary_key = "id";

    public function __construct(Array $properties = []){
        parent::__construct($properties);
    }

    public function queryUser(string $email_user, string $password) : bool | Array{
        
        $query = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1";
        $result = Injector::get("QueryBuilder")->ownQuery($query, [$email_user, $password]);

        if(empty($result)){
            return false;
        }else{
            return $result[0];
        }
    }


}