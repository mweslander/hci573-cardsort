<?php

        
class Homecontroller extends Basecontroller{
    
            
    public function __construct() {
        parent::__construct();
       
    }
    
    public function index($arg = false){
        //Default method for controller
        $this->_page->title = 'Home';
       $this->_page->render('pages/home', True);       
    }
    
    public function home($arg = false){
        //echo "HomeController Home Method $arg<br/>";
        $this->_page->title = 'Home|Home';
        $this->_page->render('pages/home', True);
    }
}