<?php


/*
 * UX TEST SUBJECT Controller
 * 
 * This is where the magic happens for the User Experience Researcher.
 * 
 */


class UxtsController extends Basecontroller 
{
    // First our constructor method
    public function __construct() 
    {
        // Calls the baseController construct.
        // This gives us a new page template and initiates the authSession
        parent::__construct();
    }

    public function index($args=null) 
    {
        //check SESSION before loading SECURE PAGE
        //Check session['loggedin'] and session['activated']
        $loggedin = AuthSession::getSession('loggedin');
        $activated = AuthSession::getSession('activated');
        if ($activated == TRUE && $loggedin == TRUE) 
        {
            
            // Use $args to find the card sort study in the database, and return 
            // it in two arrays. array(StudyName=>AmazonMenu,StudyID=>1234,Cards=>array(card1, card2, card3, etc))
            
          echo $args;  
            
          echo AuthSession::getSession('uid');
            
            
            
            
            
            
            $this->_pageTemplate->title = 'UX TEST SUBJECT';
            $this->_pageTemplate->render('/ts/home', TRUE);
        } 
        else 
        {
            //render 404 Error Page
            $this->_pageTemplate->render('404_page',TRUE); 
        }
    }

}