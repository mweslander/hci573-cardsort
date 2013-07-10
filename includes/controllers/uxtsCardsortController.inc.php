<?php

/*
 * UxtsCardController class
 * 
 * This class handles AJAX calls for cards for a specific cardsort
 * 
 * @author Michael Weslander
 */

// This is how the classes are being called 
// Only instead of writing all of this out, Brett wrote an autoloader
// that goes through and fetches them for us
require_once '../constants/paths.inc.php';
require_once (CONST_PATH . 'sql.inc.php');
require_once (CLASS_PATH . 'database.inc.php');
require_once (CLASS_PATH . 'commons.inc.php');
require_once (MODEL_PATH . 'baseModel.inc.php');
require_once (MODEL_PATH . 'cardsortModel.inc.php');
require_once (MODEL_PATH . 'cardModel.inc.php');
require_once (MODEL_PATH . 'testCardModel.inc.php');
require_once (MODEL_PATH . 'testSubjectModel.inc.php');
require_once (MODEL_PATH . 'testModel.inc.php');
require_once (MODEL_PATH . 'demographicModel.inc.php');
require_once (CTRL_PATH . 'baseController.inc.php');

class UxtsCardsortController extends Basecontroller {

    private $_model = 'CardsortModel';

    public function __construct() {
        // I don't think we really need to construct the Basecontroller here
        // We may not even need to extend the Basecontroller
        // The Basecontroller is creating a new page template, and this
        // particular page doesn't need a template per-se, or it might, I'm not
        // exactly sure. Basically I will be running a function that checks the
        // post data, sends it to the UserModel, gets info from the UserModel
        // then sends info back to the page that called it.
        // parent::__construct();  
        $this->cardsort_handling();
    }

    // This is our main switchboard function
    // It gets called when the class is initiated
    public function cardsort_handling() {
        // First set empty error and message arrays
        $error = array();
        $message = array();

        // This runs a series of checks to make sure that the post data
        // behaves properly
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'save') {
                $this->_save_cardsort();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Save the cardsort method
    // This processes the UXTS's input and saves the information into the database
    private function _save_cardsort() {
        // First set empty error and message arrays
        $error = array();
        $message = array();

        // Check for the cs_id
        if (isset($_POST['cs_id'])) {
            $cs_id = $_POST['cs_id'];
            $cardsort = CardsortModel::find_by_id($cs_id);
        } else {
            $error['cs_id'] = "No (cardsort) cs_id was sent";
        }

        // Check for the ts_email
        if (isset($_POST['ts_email'])) {
            $ts_email = Commons::filter_string($_POST['ts_email']);
        } else {
            // Otherwise add an error to the array
            $error['email'] = "Please enter an email address";
        }
        // We now have all the necessary parts to create a test subject
        // And we also have all the necessary parts to create a test
        // Check for cards
        if (isset($_POST['cards'])) {
            $raw_cards = $_POST['cards'];
        } else {
            $error['cards'] = "Please sort the cards, and submit again";
        }

        // Check for dmgs
        if (isset($_POST['dmgs'])) {
            // If none was sent as part of the post
            // then there were no demographics added to the sort by the uxr
            if ($_POST['dmgs'] == 'none') {
                // Set dmgs to null for processing later
                $dmgs = null;
            }
            // Otherwise
            else {
                // set dmgs to the post variable
                $raw_dmgs = $_POST['dmgs'];
            }
        } else {
            $error['dmgs'] = "This shouldn't happen, my fault, please try again";
        }


        // If the error array is empty, then begin processing
        if (empty($error)) {

            //TestSubjectModel, 
            //TestModel, 
            //TestCardModel 
            //testDmg models (date, int & string)
            //*******************************************************
            //Need to make sure only TestSubject and CS_ID are unique together - (TestSubjectModel)
            //********************************************************                       
            $user = new TestSubjectModel();
            $user->cs_id = $cs_id;
            $user->ts_email = $ts_email;

            //Check if cs_id and ts_email already exist 
            $rowUnique = $user->check_if_ts_user_exists($cs_id, $ts_email);

            var_dump($rowUnique);
            die;
            if (!isset($rowUnique[0]) && sizeof($rowUnique) == 0) {
                
                //create new users                
                $user->cs_id = $cs_id;
                $user->ts_email = $ts_email;
                $user->saveTS();
                               
                
            } elseif (sizeof($rowUnique) > 1) {
                $error = 'There are to many of the same users in the database';
            }else{
                $error = 'Something went wrong, try again';
            }
            
            //******************************************************
            //GET TEST SUBJECTS ID FOR CURRENT TEST - (TestModel)
            //This must be unquic in the usort_test_subjects Table
            //******************************************************
            //get the ts_id from the matching card sort id and test subject email
            $findTestSubjectId = $user->check_if_ts_user_exists($cs_id, $ts_email);
            //If the test subject exist in the db then add new test 
            If(isset($findTestSubjectId[0])){
            //Create timestamp for finishing the test
            $test = new TestModel();
            $test->ts_id = $findTestSubjectId[0]['id'];
            //USEING SQL NOW()IN MODEL //$test->cs_finished = now();
            $test->saveTest();
            
            }
           
            //******************************************************
            //GET CARDS TO SAVE - Loop through array and save (TestCardModel)
            //
            //******************************************************
            
            //Array Structure - array[0] => array(
            //                                  [id]=>1,
            //                                  [cs_id]=>4,
            //                                  ['card_label']),
            //                  array[1] => array(
            //                                  [id]=>2,                
            var_dump($raw_cards);
            $decoded_cards = json_decode($raw_cards);
            var_dump($decoded_cards);
            
            //Loop through $raw_cards to create array or save one card at a time
//            foreach ($decoded_cards as $key => $value) {
//                $arrCard[$key] = $value;
//            }
            foreach ($decoded_cards as $tsCard => $tsCategory)
            {
                $card = new TestCardModel;
                $card->card_id = $tsCard;
                $card->test_category = $tsCategory;
                var_dump($card);
            }
            
            die;
            
//            $testCards = new TestCardModel();
//            $testCards->card_id = ;
//            $testCards->test_id = ;
//            $testCards->test_category = ;
//            $testCards->save();
            //******************************************************
            //THE BEAST - SAVE DMG data into (usort_test_dmg_text, usort_test_dmg_int, usort_test_dmg_string) 
            //
            //******************************************************
        //
            
            
            
                
                
        }



        // Return the data in an array
        $data_return = array(
            "error" => $error,
            "message" => $message
        );
        // JSON encode the data return array to make it easy to use
        echo json_encode($data_return);
    }

    // This goes to the database and gets the details of the cardsort
    public function cardsort_details($cs_id = 0) {
        $cardsort = CardsortModel::find_by_id($cs_id);
        return $cardsort;
    }

}

$uxtsCardsort = new UxtsCardsortController();