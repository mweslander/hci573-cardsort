<?php

        
class Membercontroller extends Basecontroller{
    
            
    public function __construct() {
        parent::__construct();
        
        $loggedin = auth::getSession('loggedin');
        
        If($loggedin == FALSE){
            auth::destroySession();
            header('location: login');
            exit();            
        }
        
        
        
    }
    
    public function index(){
        //Default method for controller
       $this->_page->title = 'Secure';
       $this->_page->set('username',$this->_model->getUsername());
       $this->_page->set('email', $this->_model->getEmail());
       $this->_page->render('pages/secure/members', True); 
       
       
       
    }
    
    public function logout(){
        
        auth::destroySession();
        header('location: ../login');
       
        
    }
   
    
}