<?php

// This class is the base of all of the models of the app, contains the common properties and actions of the models
class Model{

    // @param string $table_name is the name of the table for each model that could be redefined if it's necessary
    protected static string $table_name = "";
    //@param string $primary_key is the name of the primary_key for each model that could be redefined if it's necessary
    protected static string $primary_key = "id";
    // @param array $properties is a collection of the properties of the models obtained from the database
    protected Array $properties = [];

    public function __construct(Array $properties = []){
        $this->properties = $properties;
    }

    public function __get($propiedad){
        if(property_exists($this, $propiedad)){
            return $this->$propiedad;
        }
    }

    public function __set($propiedad, $valor){
        if(property_exists($this, $propiedad)){
            $this->$propiedad = $valor;
        }
    }

    // Update the properties for each update in the model for each query
    public function updateProperties(Array $properties){
        $this->properties = array_merge($this->properties, $properties);
    }

    // Function to create and return new model that save a new register for it and more actions
    public static function create(Array $properties){
        $model = new static($properties);
        $model->save();
        return $model;
    }

    public function save(): bool{

        // It's necessary that of all of the models have defined it's table name
        if(empty(static::$table_name)){
            throw new Exception("ERROR, NOMBRE DE LA TABLA NO DEFINIDA PARA EL MODELO: " . strtoupper(get_class(new Static)) . "\n", 1);
        }else{
            return Injector::get("QueryBuilder")->createOne(static::$table_name, $this->properties);
        }
    }

    public static function selectOne(string $id) : static{

        $model = new static();
        $model->findOne($id);
        return $model;
    }

    // Query one of the models in the database
    public function findOne(string $id): bool{

        // It's necessary that of all of the models have defined it's table name
        if(empty(static::$table_name)){
            throw new Exception("ERROR, NOMBRE DE LA TABLA NO DEFINIDA PARA EL MODELO: " . strtoupper(get_class(new Static)) . "\n", 1);
        }else{
            
            $result = Injector::get("QueryBuilder")->selectOne(static::$table_name, static::$primary_key, $id);

            if(empty($results)){
                return false;
            }else{
                // Update the properties of that model
                $this->properties = $result;
                return true;
            }
        }

    }

    // Query all of the models in the database
    public function selectAll(){

        // It's necessary that of all of the models have defined it's table name
        if(empty(static::$table_name)){
            return throw new Exception("ERROR, NOMBRE DE LA TABLA NO DEFINIDA PARA EL MODELO: " . strtoupper(get_class(new Static)) . "\n", 1);
        }else{

            $results = Injector::get("QueryBuilder")->selectAll(static::$table_name);
            
            if(empty($results)){
                return false;
            }else{
                // It's necessary return new models that store each of the registers how properties
                return array_map(fn($result) => new Static($result), $results);
            }
        }
    }

    // Update one of the models in the database
    public function update(Array $properties){
        // (string) $this->propiedades[static::$primary_key] gives the value of the id of the model that invoke this not static method
        $result = Injector::get("QueryBuilder")->updateOne(static::$table_name, static::$primary_key, (string) $this->propiedades[static::$primary_key], $properties);
        $this->updateProperties($properties);
        return $result;
    }

    // Delete one of the models in the database
    public function delete(){
        // (string) $this->propiedades[static::$primary_key] gives the value of the id of the model that invoke this not static method
        $result = Injector::get("QueryBuilder")->deleteOne(static::$table_name, static::$primary_key, (string) $this->propiedades[static::$primary_key]);
        return $result;
    }
}