<?php


/*
 * UXR Controller
 * 
 * This is where the magic happens for the User Experience Researcher.
 * 
 */


class UxrController extends Basecontroller 
{
    // First our constructor method
    public function __construct() 
    {
        // Calls the baseController construct.
        // This gives us a new page template and initiates the authSession
        parent::__construct();
    }

    public function index() 
    {
        //check SESSION before loading SECURE PAGE
        //Check session['loggedin'] and session['activated']
        $loggedin = AuthSession::getSession('loggedin');
        $activated = AuthSession::getSession('activated');
        if ($activated == TRUE && $loggedin == TRUE) 
        {
            $this->_pageTemplate->title = 'UXR Page';
            $this->_pageTemplate->render('/uxr/home', TRUE);
        } 
        else 
        {
            //render 404 Error Page
            $this->_pageTemplate->render('404_page',TRUE); 
        }
    }

}