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
require_once (MODEL_PATH . 'testDmgModel.inc.php');
require_once (MODEL_PATH . 'testDmgDateModel.inc.php');
require_once (MODEL_PATH . 'testDmgIntModel.inc.php');
require_once (MODEL_PATH . 'testDmgStringModel.inc.php');
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
            // Use cardsort->id
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
                $raw_dmgs = null;
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
        if (empty($error)) 
        {
            
            // Set an empty error array for this section
            $err = array();                  
            
            // We need to make sure we have a cardsort id
            if ($cardsort->id)
            {
                $test_subject = new TestSubjectModel();
                $test_subject->cs_id = $cardsort->id;
                $test_subject->ts_email = $ts_email;

                // Check if cs_id and ts_email already exist 
                // Returns true if there is a user and false if there is not
                $repeatTS = $test_subject->check_if_ts_user_exists($cs_id, $ts_email);

                // If the check for a repeat Test Subject comes back false
                // Then I suppose we can let them in
                if ($repeatTS == false) 
                { 
                    //create a new test subject row               
                    $test_subject->saveTS();
                    // This works!
                    // echo $test_subject->id;
                    if ($test_subject->id)
                    {
                        // Now that we have our test subject
                        // We can start a new test!
                        $test = new TestModel();
                        // Set the ts_id in the test table to the test subject's id
                        // This links them together
                        $test->ts_id = $test_subject->id;
                        // Then save the test to the database
                        $test->saveTest();
                        // Now let's make sure we have a $test->id
                        if ($test->id)
                        {
                            // So we can go to town on the cards!
                            // JSON decode the
                            $decoded_cards = json_decode($raw_cards);
                            // For each card
                            foreach ($decoded_cards as $tsCard => $tsCategory)
                            {
                                // Make a new card object
                                $card = new TestCardModel;
                                $card->card_id = $tsCard;
                                $card->test_id = $test->id;
                                $card->test_category = $tsCategory;
                                // And save it to the database
                                $card->save();
                            }
                            
                            // With the test->id we can also take care of the demographics
                            $decoded_dmgs = json_decode($raw_dmgs);
                            // For each demographic
                            foreach ($decoded_dmgs as $tsDmgID => $tsDmgValue)
                            {
                                // Get the right type from the Demographics table
                                $demographics = DemographicModel::find_by_id($tsDmgID);
                                // Check to make sure there is a type
                                if ($demographics->dmg_type)
                                {
                                    // Make sure we have the right model & database table
                                    switch ($demographics->dmg_type)
                                    {
                                        case 'date':
                                            $dmg = new TestDmgDateModel();
                                            break;
                                        case 'int':
                                            $dmg = new TestDmgIntModel();
                                            break;
                                        default:
                                            $dmg = new TestDmgStringModel();
                                    }
                                    // Set the object parameters
                                    $dmg->test_id = $test->id;
                                    $dmg->dmg_id = $demographics->id;
                                    $dmg->dmg_value = $tsDmgValue;
                                    $dmg->save();
                                    
                                }
                                else
                                {
                                    $err['dmg_type'] = "Sorry, we couldn't figure out the type of demographic.";
                                }
                            }
                        $message['success'] = "Thanks for completing the cardsort!";    
                        }
                        else
                        {
                            $err['test_id'] = "Error with the test! Sorry.";
                        }
                    }
                    else
                    {
                        $err['test_subject'] = "We had a problem with the test subject";
                    }
                }
                else
                {
                    // Otherwise, throw an error
                    $err['repeat_user'] = 'Are you trying to do this study more than once? If so, use a different email';
                }
            }
            else
            {
                $err['cardsort_id'] = "Sorry! We had an error with the cardsort id";
            }
        } // Otherwise the errors weren't empty
        $error = $err;                
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