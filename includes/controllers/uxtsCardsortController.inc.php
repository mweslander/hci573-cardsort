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
require_once (MODEL_PATH . 'demographicModel.inc.php');
require_once (CTRL_PATH . 'baseController.inc.php');


class UxtsCardsortController extends Basecontroller
{
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
    public function cardsort_handling()
    {   
        // First set empty error and message arrays
        $error = array();
        $message = array();
        
        // This runs a series of checks to make sure that the post data
        // behaves properly
        if (isset($_POST['submit']))
        {
            if ($_POST['submit'] == 'save')
            {
                $this->_save_cardsort();
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    // Save the cardsort method
    // This processes the UXTS's input and saves the information into the database
    private function _save_cardsort()
    {
        // First set empty error and message arrays
        $error = array();
        $message = array();
        
        // Check for the cs_id
        if (isset($_POST['cs_id']))
        {
            $cs_id = $_POST['cs_id'];
            $cardsort = CardsortModel::find_by_id($cs_id);
        }
        else
        {
            $error['cs_id'] = "No (cardsort) cs_id was sent";
        }
        
        // Check for the ts_email
        if (isset($_POST['ts_email']))
        {
            $ts_email = Commons::filter_string($_POST['ts_email']);
        }
        else
        {
            // Otherwise add an error to the array
            $error['email'] = "Please enter an email address";
        }
        // We now have all the necessary parts to create a test subject
        // And we also have all the necessary parts to create a test
        
        // Check for cards
        if (isset($_POST['cards']))
        {
            $raw_cards = $_POST['cards'];
        }
        else
        {
            $error['cards'] = "Please sort the cards, and submit again";
        }
        
        // Check for dmgs
        if (isset($_POST['dmgs']))
        {
            // If none was sent as part of the post
            // then there were no demographics added to the sort by the uxr
            if($_POST['dmgs'] == 'none')
            {
                // Set dmgs to null for processing later
                $dmgs = null;
            }
            // Otherwise
            else
            {
                // set dmgs to the post variable
                $raw_dmgs = $_POST['dmgs'];
            }
        }
        else
        {
            $error['dmgs'] = "This shouldn't happen, my fault, please try again";
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
    public function cardsort_details($cs_id = 0)
    {
        $cardsort = CardsortModel::find_by_id($cs_id);
        return $cardsort;
    }
}
$uxtsCardsort = new UxtsCardsortController();