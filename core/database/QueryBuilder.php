<?php

// This class provides the abstractions of the common operations with the database how CRUD
class QueryBuilder{

    /**
     * @param PDO $connection Is the param to define the connector atribute and make the operations with the database
    */
    public function __construct(private PDO $connection){}

    /**
     * @param string $table_name It's to define the name of the table in the query
     * @param array $properties It's to define the fields and the values of the query (must be associative)
     * This function does the query to create one record on the database (INSERT)
    */
    public function createOne(string $table_name, Array $properties) : bool{

        $result = null;
        $fields = implode(", ", array_keys($properties));
        $values = array_values($properties);
        $wildcards = implode(", ", array_fill(0, count($properties), "?"));        

        try {
            $query = $this->connection->prepare("INSERT INTO {$table_name}({$fields}) VALUES({$wildcards})");
            $result = $query->execute($values);
            $query->closeCursor();
        } catch (PDOException $error) {
            echo $error;
            $result = false;
        }
        return $result;
    }

    /**
     * @param string $table_name It's to define the name of the table in the query     
     * This function does the query to return all of the record in a table (SELECT *)
    */
    public function selectAll(string $table_name): Array | null{

        $result = null;
        
        try {
            $query = $this->connection->prepare("SELECT * FROM {$table_name}");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC); // Return how a associative array
            $query->closeCursor(); // ! Close the cursor
        } catch (PDOException $error) {
            echo $error;
            $result = null;
        }
        
        return $result;
    }

    /**
     * @param string $table_name It's to define the name of the table in the query     
     * This function does the query to return all of the record in a table (SELECT *)
    */
    public function selectOne(string $table_name, string $pk, string $id): Array | bool{

        $result = null;
        
        try {
            $query = $this->connection->prepare("SELECT * FROM {$table_name} WHERE {$pk} = ? LIMIT 1");
            $query->execute([$id]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC); // Return how a associative array
            $result = $result[0];
            $query->closeCursor();
        } catch (PDOException $error) {
            echo $error;
            $result = false;
        }
        return $result;

    }
    public function updateOne(string $table_name, string $pk, string $id, Array $properties) : bool{

        $fields = array_keys($properties);
        $values = array_values($properties);
        $fields_wildcards = array_map(
            fn($field) => "{$field} = ?", 
        $fields);

        $fields_wildcards = implode(",", $fields_wildcards);
        $result = null;
        
        try {
            $query = $this->connection->prepare("UPDATE {$table_name} set {$fields_wildcards} WHERE {$pk} = ?");
            $query->execute([...$values, $id]);
            $query->closeCursor();
            $result = true;
        } catch (PDOException $error) {
            echo $error;
            $result = false;
        }
        return $result;
    }
    public function deleteOne(string $table_name, string $pk, string $id): bool{

        $result = null;

        try {
            $query = $this->connection->prepare("DELETE {$table_name} WHERE{$pk} = ?");
            $query->execute([$id]);
            $query->closeCursor();
            $result = true;
        } catch (PDOException $error) {
            echo $error;
            $result = false;
        }
        return $result;
    }

    public function ownQuery(string $query, Array $values): Array | bool{

        if(empty($values)){
            return throw new Exception("NO SE ACEPTAN ARREGLOS VACIOS COMO VALORES en la función ownQuery de la clase QueryBuilder", 1);
        }
        if(empty($query)){
            return throw new Exception("NO SE ACEPTAN CONSULTAS VACIAS en la función ownQuery de la clase QueryBuilder", 1);
        }
        if(!str_contains($query, "?")){
            return throw new Exception("NO SE ACEPTAN CONSULTAS SIN COMODINES en la función ownQuery de la clase QueryBuilder", 1);
        }

        $getModels = false;

        if(str_contains($query, "SELECT")){
            $getModels = true;
        }

        $result = null;

        try {

            $query = $this->connection->prepare($query);
            $query->execute($values);
            
            if($getModels){
                $result = $query->fetchAll(PDO::FETCH_ASSOC); // Return how a associative array   
            }else{
                $result = true;
            }

            $query->closeCursor();

        } catch (PDOException $error) {
            echo $error;
            $result = false;
        }
        return $result;

    }

}