<?php

/*
 * Base Model
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
}

// PHP closing tag ommitted intentionally