<?php

abstract class Basecontroller {

    protected $_model;
    protected $_page;
    protected $_cmmsFunc;
    protected $_error;

    public function __construct() {
        //echo "<br/>Base Controller<br/>";
        //load page view - This gives all extended controllers access to the page object
        $this->_page = new Page();
        $this->_cmmsFunc = new Commons();
        
        
        //start up session for all pages. 
        auth::initSession();
    }

    public function _setModel($modelName) {
        $this->_model = new $modelName();
    }

//	
//    protected function _setView($name,$template){                
//                $this->page = new Page();  
//                $this->page->render($name, $template);
//        }
}

