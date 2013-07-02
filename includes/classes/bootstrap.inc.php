<?php

/*
 * Bootstrap
 * 
 * Checks the system is ready to start. 
 * Direct the controller and gets user specific variables
 * 
 * @author Brett Young
 * 
 */

class bootstrap {
    
    private $controller = null;
    private $method = null;    
    private $params = array();
    
    
    
    public function __construct() {
        $this->structureGet($_GET);
        $this->setController();
        $this->setMethod();
        
        
    }
    //Restructures GET into a params array 
    //could also clean url in the future    
    
    private function structureGet($url){
        $params = $url;
        //set params from url controller/method/args
        if(!empty($params['url'])){
        $this->params = explode('/', $params['url']);
            //if method is empty set default method to index
            if(empty($this->params[1])){
                $this->params[1] = 'index';
            }
            //sets controller to default if controller is missing from url
            // ie... //method when it should have been /controller/method
            if(empty($this->params[0])){
                $this->params[0] = 'home';
            }
        }else{
            //set default controller/method
            $this->params[0] = 'home';
            $this->params[1] = 'index';            
        }
    }

    private function setController(){       
        
       $controller = $this->params[0];
                
       //At this point the controller should allows 
       //have a value comming from structureGet() 
       $controllerFile = strtolower($controller) . 'Controller.inc.php';
       if(!file_exists(CTRL_PATH . $controllerFile)){
                $controller = 'homeController';                
                $this->controller = new $controller;  
                //we could set error here and not load homecontroller
                return false;
       }         
       $controller = strtolower($controller) . 'Controller';
       $this->controller = new $controller();    
       
    }
    
    private function setMethod(){
        
        $this->method = $this->params[1];
        $method = $this->method;
        $controller = $this->controller;
        
        //At this point Controller and method should 
        //always have a value either default home/index or whatever is in url
        
        //checks if method doesnt exist
        if(!method_exists($controller, $method)){
                   $controller->index();
                   //we could set an error here and not load index method
                   return FALSE;
        }
        
        //check if method has arguments                
        if(isset($this->params[2]) && !empty($this->params[2])){
            //echo 'method exists and has args';
            $controller->{$method}($this->params[2]);
            return FALSE;
        }
        
        //echo 'method exists';
        //call method in assigned controller
        $controller->{$method}();
    }
    
    
    

}