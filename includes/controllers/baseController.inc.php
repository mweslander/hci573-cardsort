<?php

/*
 * Base Controller
 */

abstract class Basecontroller
{
    // This is the page template variable. Available to subclasses.
    protected $_pageTemplate;
    
    // When the Basecontroller is initiated, this is what we get
    public function __construct() 
    {
        // First we set the page template to a new PageTemplate object.
        // Page template is located in includes/classes/pageTemplate.inc.php
        $this->_pageTemplate = new PageTemplate();
        // Then we initiate the session
        // This is located in includes/classes/authSession.inc.php
        AuthSession::initSession();        
    }
}