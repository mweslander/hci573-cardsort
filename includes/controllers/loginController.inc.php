<?php



class LoginController extends Basecontroller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        //set variables before calling render
        $this->_pageTemplate->title = 'Login Page';
        $this->_pageTemplate->render('login',TRUE);
                    
    }
}