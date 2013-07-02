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


    public function __construct() {
        
        $this->getController($_GET);
        
        
        
    }
    
    public function getController($url){
        
        //Bretts working on this
        //Notes for me work on $url params and htaccess params
        //split function into getController, getMethod, getArgs
        
        
        
        //Controller has been requested
        if(!isset($url['c']) || empty($url['c'])){
            //load default controller - ie home            
            $controller = 'homecontroller';                
            new $controller; 
            return false;
        }
        
       //The requested controller doesn't exist              
       if(isset($url['c']) && !empty($url['c'])){
           $controller_file_name = strtolower($url['c']) . 'Controller.inc.php'; 
           if(!file_exists(CTRL_PATH . $controller_file_name)){
                $controller = 'homecontroller';                
                new $controller;  
                return false;
                // or we can call an error controller
           }
       }
       
       //Get the existing controller
       if(isset($url['c']) && !empty($url['c'])){
           $controller = ucwords(strtolower($url['c'])) . 'controller';
           $this->controller = new $controller();
           
           //check if method has args
           if(isset($_GET['a']) && !empty($url['a'])){
               
               //check is method doesn't exists
               if(!method_exists($this->controller, $_GET['a'])){
                   echo "Error: Method doesn't exist..Line 54 bootstrap";
                   return FALSE;
               }
               //call controller with no methods, except the default
               $this->controller->{$_GET['m']}($_GET['a']);
               
           //check method
           }elseif(!isset($_GET['m']) && empty($url['m'])){
               //check is method doesn't exists
               if(!method_exists($this->controller, $_GET['a'])){
                   echo "Error: Method doesn't exist..Line 64 bootstrap";
                   return FALSE;
               }
               
               $this->controller->{$_GET['m']};
               
           }else{
               
               $this->controller->index();
           }
           
           
           
       }
    }
    
    
    
    

}