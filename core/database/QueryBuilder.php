<?php

// This class provides the abstractions of the common operations with the database how CRUD
class QueryBuilder{

    public function __construct(private PDO $connection){}

    public function createOne(string $table_name, Array $properties) : bool{

        $result = null;
        $fields = implode(", ", array_keys($properties));
        $values = array_values($properties);
        $wildcards = implode(", ", array_fill(0, count($properties), "?"));

        // !TODA operación con la BD puede fallar, así que siempre realizar esta práctica

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
    public function selectOne(string $table_name, string $pk, string $id): Array | bool{

        $result = null;
        
        try {
            $query = $this->connection->prepare("SELECT * FROM {$table_name} WHERE {$pk} = ? LIMIT 1");
            $query->execute([$id]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC); // Return how a associative array
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
            $query = $this->connection->prepare("UPDATE {$table_name} set{$fields_wildcards} WHERE {$pk} = ?");
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

}