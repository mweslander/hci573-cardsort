<?php

        
class Logincontroller extends Basecontroller{
    
            
    public function __construct() {
        parent::__construct();
        //echo "LoginController<br/>";
        
        
    }
      public function index($arg = false){
        //Default method for controller
          
       $this->_page->title = 'Login';
       $this->_page->render('pages/login', TRUE);              
      }
    
//    public function home($arg = false){
//        $this->_page->render('pages/login', TRUE);
//        $this->_page->title = 'Login || home';
//        echo "LoginController Home Method $arg<br/>";       
//    }
    public function logins(){
        
        $this->_model->logins();
                       
    }
    
}