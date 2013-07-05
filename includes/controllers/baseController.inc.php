<?php

/*
 * Base Controller
 */

abstract class Basecontroller{
    protected $_pageTemplate;
    
    public function __construct() {
        $this->_pageTemplate = new PageTemplate();
         AuthSession::initSession();        
    }
    
    
    
}