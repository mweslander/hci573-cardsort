<?php

/*
 * Base Model
 * 
 * Contains common database methods
 * 
 * @authors Michael Weslander & Brett Young
 */

abstract class BaseModel
{
    
    // Parameters
    // Database connection
    protected $_db;
    
    // Construtor method
    // Loads when the class is instantiated
    public function __construct() 
    {
        // Sets the database connection
        // using the static method from the database class
        $this->_db = Database::init();
    }  
   
    // Find all 
    // Used to find every row in a specific table in the database
    public static function find_all()
    {
        return static::find_by_sql("SELECT * FROM " . static::$table_name);
    }
    
    // Find by id
    public static function find_by_id($id=0)
    {
        // Prepare SQL
        $sql  = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE id=" . $id . " LIMIT 1";
        // Use find_by_sql function
        $result_array = static::find_by_sql($sql);
        // $found = $result_array->fetch(PDO::FETCH_ASSOC);
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    
    
    // Find by SQL
    // @return object array
    public static function find_by_sql($sql="") 
    {
        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // This prepares the sql for the query
            $prepared = $this->_db->prepare($sql);
            // If this worked
            if ($prepared)
            {
                // Get the result set back
                $result_set = $prepared->execute(); 
                // Set an empty object_array
                $object_array = array();
                // Turn the row into an associative array
                // with a key of column name and a value of the row
                while ( $row = $result_set->fetch(PDO::FETCH_ASSOC)) 
                {
                    // Use instantiate method below to make objects
                    // out of results and add them to the object array
                    $object_array[] = self::_instantiate($row);
                }
                // Return the object array
                return $object_array; 
            }
            
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    // Count all method
    // Counts all the rows in a given db table
    public static function count_all()
    {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $prepared = $this->_db->prepare($sql);
        // If this worked
        if ($prepared)
        {
            // Get the result set back
            $result_set = $prepared->execute();
            $row = $result_set->fetch(PDO::FETCH_ASSOC);
            return array_shift($row);
        }
    }
    
    // Instantiate method
    // loops through the records and attributes
    // and instantiates an object of called class
    private static function _instantiate($record) 
    {
        // Could check that $record exists and is an array
        $class_name = get_called_class();
        $object = new $class_name;

        // Simple, long-form approach:
        // $object->id 		= $record['id'];
        // $object->username 	= $record['username'];
        // $object->password 	= $record['password'];
        // $object->first_name = $record['first_name'];
        // $object->last_name 	= $record['last_name'];

        // More dynamic, short-form approach
        foreach($record as $attribute=>$value) 
        {
            if($object->_has_attribute($attribute)) 
            {
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    
    // Has attribute method
    // checks to see if an attribute key/value pair exists
    private function _has_attribute($attribute)
    {
        // get_object_vars returns an associative array with all attributes
        // (incl. private ones!) as the keys and their current values as the value
        $object_vars = get_object_vars($this);
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $object_vars);
    }
    
    // This gets the attributes ready for PDO
    protected function _attributes() 
    {
        // return an array of attribute keys and their values
        $attributes = array();
        // $db_fields comes from the called class
        foreach(static::$db_fields as $field) 
        {
            if (property_exists($this, $field)) 
            {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
    
    // Save Method
    // This checks to see if the id isset, if so, it updates, if not, it creates
    public function save()
    {
        // A new record won't have an id yet
        return isset($this->id) ? $this->_update() : $this->_create();
    }
    
    // Create Method - Dynamically add an object to the database
    protected function _create()
    {
        // Dynamically create SQL statement
        // using the $table_name from the called class
        // and the keys for the attributes from the $db_fields
        // and the attributes from the called object
        $attributes = $this->_attributes();
        $sql  = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        
        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // Prepare the sql 
            $prepared = $this->_db->prepare($sql);
            if ($prepared)
            {
                $prepared->execute(); 
                $this->id = $this->_db->lastInsertId();
                return true;
            }
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    // Update Method 
    // Dynamically update an object with an existing record
    protected function _update()
    {
        // Dynamically create SQL statement
        // using the $table_name from the called class
        // and the keys for the attributes from the $db_fields
        // and the attributes from the called object
        $attributes = $this->_attributes();
        // Set an empty attribute pairs array
        $attribute_pairs = array();
        // For each attribute set an attribute pair
        foreach($attributes as $key => $value) 
        {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql  = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $this->id;
        
        //var_dump($sql);
        
        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // Prepare the sql 
            $prepared = $this->_db->prepare($sql);
            if ($prepared)
            {
                $prepared->execute(); 
                return true;
            }
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    // Delete Method
    public function delete()
    {
        // Prepare the SQL statement
        $sql  = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE id=" . $this->id;
        $sql .= " LIMIT 1";
        
        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // Prepare the sql 
            $del = $this->_db->prepare($sql);
            if ($del)
            {
                $del->execute(); 
            }
            return ($del->rowCount() == 1) ? true : false;
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }
    }
}

// PHP closing tag ommitted intentionally