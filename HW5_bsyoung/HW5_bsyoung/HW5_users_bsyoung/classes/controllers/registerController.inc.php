<?php

        
class Registercontroller extends Basecontroller{
    
            
    public function __construct() {
        parent::__construct();        
        
    }
     public function index($arg = false){
        //Default method for controller
       $this->_page->title = 'Register';  
       $this->_page->set('model',$this->_model->getError());
        
       $this->_page->render('pages/register', True);
       
    }
    public function register($arg = false){
        //register method
        
        $this->_model->register();
       $this->_page->set('model',$this->_model->getError());
        
        
    }
}