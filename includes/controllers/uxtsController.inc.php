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
           
            $cardsort = new CardsortModel();
            $cardsort->user_id = $user_id;
            $listStudy = $cardsort->list_of_study();

            $i = 0;
            if (!empty($listStudy)) {
                //loop through to get the id and name of the studies
                foreach ($listStudy as $value) {
                    $studies[$listStudy[$i]['id']] = $listStudy[$i]['cs_name'];
                    $i++;
                }
                //Set page var study to list of studies
                $this->_pageTemplate->study = $studies;
            }

            //Get Cards for each study, when the used calls that study
            $studyID = $args;
            //Only load cards when a study has been clicked
            If ($studyID !== Null) {
                //Get the name of the study
                $this->_pageTemplate->studyName = "Working On";
                //Get the Cards for the selected study
                $card = new CardModel();
                $card->cs_id = $args;
                $listCards = $card->list_cards_by_study();

                $i = 0;
                //loop through to get the id and name of the studies
                if (!empty($listCards)) {
                    foreach ($listCards as $value) {
                        $cards[$listCards[$i]['id']] = $listCards[$i]['card_label'];
                        $i++;
                    }
                    //Set page var card to list of cards in study
                    $this->_pageTemplate->card = $cards;
                }

                //Get the categories for the selected study
                $cat = new CategoryModel();
                $cat->cs_id = $args;
                $listCategorys = $cat->list_categorys_by_study();

                $i = 0;
                //loop through to get the id and name of the studies
                if (!empty($listCategorys)) {
                    foreach ($listCategorys as $value) {
                        $category[$listCategorys[$i]['id']] = $listCategorys[$i]['cat_label'];
                        $i++;
                    }

                    //Set page var card to list of categoryies in study
                    $this->_pageTemplate->category = $category;
                }
            }


            $this->_pageTemplate->title = 'UX TEST SUBJECT';
            $this->_pageTemplate->render('/ts/home', TRUE);
        } else {
            //render 404 Error Page
            $this->_pageTemplate->render('404_page', TRUE);
        }
    }

    public function save() {
        
    }

    public function addCard() {
        echo "add";
    }

    public function addCatorgory() {
        
    }

}