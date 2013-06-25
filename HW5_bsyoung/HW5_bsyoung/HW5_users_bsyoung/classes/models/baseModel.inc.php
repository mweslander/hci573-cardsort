<?php


abstract class Basemodel{
 
    protected $_db;
    protected $_cmmsFunc;
    protected $_error;
    
    public function __construct() {
        $this->_db = Database::init();
        $this->_cmmsFunc = new Commons();
         $this->_error = Error::getInit();
        
    }
    
    
}
