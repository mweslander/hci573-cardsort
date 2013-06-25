<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Error{
    private static $_instance;
    public $error;
    
    
    public function __construct() {
        //echo "this is an error!!!!!";
    }
    public static function getInit(){
        if (!self::$_instance)
        {
            // Create a new instance of the database
            self::$_instance = new self();
        }
        // Return the instance of the database
        return self::$_instance;
    
    }

    public function setError($key, $value) {
        $this->error[$key] = $value;
    }

    public function getError() {
            
            $err = $this->error;
            return $err;
        
    }
}
// ending php tag omitted
