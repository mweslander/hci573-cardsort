<?php


/*
 * Home Controller
 */


class HomeController extends Basecontroller
{
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    //default method for controller
    public function index()
    {
        //set variables before calling render
        $this->_pageTemplate->title = 'Home Page';
        $this->_pageTemplate->render('home',TRUE);            
    }  
}