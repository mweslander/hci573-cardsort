<?php

/*
 * UX TEST SUBJECT Controller
 * 
 * This is where the magic happens for the User Experience Researcher.
 * 
 */

class UxtsController extends Basecontroller {

    // First our constructor method
    public function __construct() {
        // Calls the baseController construct.
        // This gives us a new page template and initiates the authSession
        parent::__construct();
    }

    public function index($args = null) {


        //check SESSION before loading SECURE PAGE
        //Check session['loggedin'] and session['activated']
        $loggedin = AuthSession::getSession('loggedin');
        $activated = AuthSession::getSession('activated');
        if ($activated == TRUE && $loggedin == TRUE) {
            //Get user id from Session 
            $user_id = AuthSession::getSession('uid');

            // Use $args to find the card sort study in the database, and return 
            // it in two arrays. 
            // Array(StudyName=>AmazonMenu,StudyID=>1234,Cards=>array(card1, card2, card3, etc))
//           
            //Get studies that this user is appart of
            $studies =      array(
                            1 => 'Amazon',
                            2 => 'Brett',
                            3 => 'Mike',
                            4 => 'Ann');
            //Set page var study to list array of studies
            $this->_pageTemplate->study = $studies;


            //Get Cards for each study, when the used calls that study
            $studyID = $args;
            //Only load cards when a study has been clicked
            If ($studyID !== Null) {
                $cards = array(
                    'StudyName' => 'Amazon',
                    'StudyId' => '2',
                    'label' => array(
                        'card1',
                        'card2',
                        'card3',
                        'card4',
                        'card5'
                    ),
                    'category' => array(
                        'Home',
                        'About',
                        'Contact',
                        'Books',
                        'toys'
                    )
                );

                $this->_pageTemplate->card = $cards;
            }


            $this->_pageTemplate->title = 'UX TEST SUBJECT';
            $this->_pageTemplate->render('/ts/home', TRUE);
        } else {
            //render 404 Error Page
            $this->_pageTemplate->render('404_page', TRUE);
        }
    }

}