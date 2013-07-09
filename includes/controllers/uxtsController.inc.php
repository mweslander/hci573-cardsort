<?php

/*
 * UX TEST SUBJECT Controller
 * 
 * This is where the magic happens for the User Experience Test Subject.
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

    public function index($args = null) 
    {

            // Use $args to find the card sort study in the database, and return 
            // it in two arrays. 
            // Array(StudyName=>AmazonMenu,StudyID=>1234,Cards=>array(card1, card2, card3, etc))
           
        if (isset($_GET['url']))
        {
            $prefix = "uxts/index/";
            $url = $_GET['url'];

            if (substr($url, 0, strlen($prefix)) == $prefix)
            {
                $url_id = substr($url, strlen($prefix));
                $cs_id = (int) $url_id;
            }
            else
            {
                $error['url'] = "Sorry! We had trouble parsing the url.";
            }
            // Make sure that the cs_id is set
            if (isset($cs_id))
            {
                // Initiate the cardsort
                $cardsort = CardsortModel::find_by_id($cs_id);
                //Get the name of the study
                $this->_pageTemplate->studyName = $cardsort->cs_name;
            }
            else
            {
                $error['cs_id'] = "There is no Cardsort ID";
            }
            
            if (empty($error))
            {
                // Get the Cards for the selected study
                $cards = CardModel::find_all_by_cs_id($cardsort->id);
                $this->_pageTemplate->cards = $cards;
                
                // If the cardsort type is closed
                if ($cardsort->cs_type == 'closed')
                {
                    // Get all of the categories
                    $categories = CategoryModel::find_all_by_cs_id($cardsort->id);
                    //Set page var card to list of categoryies in study
                    $this->_pageTemplate->categories = $categories;
                } // Otherwise the cardsort type is open
                
                $this->_pageTemplate->title = 'UX TEST SUBJECT';
                $this->_pageTemplate->render('/ts/home', TRUE);
            }
        }
            
//            $cardsort = new CardsortModel();
//            $cardsort->user_id = $user_id;
//            $listStudy = $cardsort->list_of_study();
//
//            $i = 0;
//            if (!empty($listStudy)) {
//                //loop through to get the id and name of the studies
//                foreach ($listStudy as $value) {
//                    $studies[$listStudy[$i]['id']] = $listStudy[$i]['cs_name'];
//                    $i++;
//                }
//                //Set page var study to list of studies
//                $this->_pageTemplate->study = $studies;
//            }
//
//            //Get Cards for each study, when the used calls that study
//            $studyID = $args;
//            //Only load cards when a study has been clicked
//            If ($studyID !== Null) {
//                //Get the name of the study
//                $this->_pageTemplate->studyName = "Working On";
//                //Get the Cards for the selected study
//                $card = new CardModel();
//                $card->cs_id = $args;
//                $listCards = $card->list_cards_by_study();
//
//                $i = 0;
//                //loop through to get the id and name of the studies
//                if (!empty($listCards)) {
//                    foreach ($listCards as $value) {
//                        $cards[$listCards[$i]['id']] = $listCards[$i]['card_label'];
//                        $i++;
//                    }
//                    //Set page var card to list of cards in study
//                    $this->_pageTemplate->card = $cards;
//                }
//
//                //Get the categories for the selected study
//                $cat = new CategoryModel();
//                $cat->cs_id = $args;
//                $listCategorys = $cat->list_categorys_by_study();
//
//                $i = 0;
//                //loop through to get the id and name of the studies
//                if (!empty($listCategorys)) {
//                    foreach ($listCategorys as $value) {
//                        $category[$listCategorys[$i]['id']] = $listCategorys[$i]['cat_label'];
//                        $i++;
//                    }
//
//                    //Set page var card to list of categoryies in study
//                    $this->_pageTemplate->category = $category;
//                }
//            }
//
//
//            $this->_pageTemplate->title = 'UX TEST SUBJECT';
//            $this->_pageTemplate->render('/ts/home', TRUE);
//
//    }
//
//    public function save() {
//        
//    }
//    public function loadCardAndCategory($args=null){
//        //Get Cards for each study, when the used calls that study
//            $studyID = $args;
//            //Only load cards when a study has been clicked
//            If ($studyID !== Null) {
//                //Get the name of the study
//                $this->_pageTemplate->studyName = "Working On";
//                //Get the Cards for the selected study
//                $card = new CardModel();
//                $card->cs_id = $args;
//                $listCards = $card->list_cards_by_study();
//
//                $i = 0;
//                //loop through to get the id and name of the studies
//                if (!empty($listCards)) {
//                    foreach ($listCards as $value) {
//                        $cards[$listCards[$i]['id']] = $listCards[$i]['card_label'];
//                        $i++;
//                    }
//                    //Set page var card to list of cards in study
//                    $this->_pageTemplate->card = $cards;
//                }
//
//                //Get the categories for the selected study
//                $cat = new CategoryModel();
//                $cat->cs_id = $args;
//                $listCategorys = $cat->list_categorys_by_study();
//
//                $i = 0;
//                //loop through to get the id and name of the studies
//                if (!empty($listCategorys)) {
//                    foreach ($listCategorys as $value) {
//                        $category[$listCategorys[$i]['id']] = $listCategorys[$i]['cat_label'];
//                        $i++;
//                    }
//
//                    //Set page var card to list of categoryies in study
//                    $this->_pageTemplate->category = $category;
//                }
//            }
//
//            
//        
//        
//    }
//    public function addCard() {
//        
//        if(isset($_POST['add'])== 'card'){
//            
//            $cardId = Commons::filter_string($_POST['cs_id']);
//            $cardLabel = Commons::filter_string($_POST['card_label']);
//            
//            
//            $card = new CardModel();
//            $card->cs_id = $cardId;
//            $card->card_label = $cardLabel;
//            
//            $cardStatus = $card->save();
//            $args = $cardId;
//            $this->loadCardAndCategory($args);
//            $this->_pageTemplate->render('/ts/home', TRUE);
//        }
//        
//        $msg = $cardStatus;
//        
//        echo json_encode($msg);
//        
//    }
//
//    public function addCategory() {
//        
//        if(isset($_POST['add'])== 'category'){
//            
//            $catId = Commons::filter_string($_POST['cs_id']);
//            $catLabel = Commons::filter_string($_POST['category_label']);
//            
//            
//            $cat = new CategoryModel();
//            $cat->cs_id = $catId;
//            $cat->cat_label = $catLabel;
//            
//            $catStatus = $cat->save();
//            
//        }
//        
//        $msg = $catStatus;
//        
//        echo json_encode($msg);
//        
    }

}