<?php

/*
 * UxrCardController class
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
require_once (MODEL_PATH . 'CardModel.inc.php');
require_once (CTRL_PATH . 'baseController.inc.php');

class UxrCardController extends Basecontroller
{
    private $_model = 'CardModel';
    
    public function __construct() {
        // I don't think we really need to construct the Basecontroller here
        // We may not even need to extend the Basecontroller
        // The Basecontroller is creating a new page template, and this
        // particular page doesn't need a template per-se, or it might, I'm not
        // exactly sure. Basically I will be running a function that checks the
        // post data, sends it to the UserModel, gets info from the UserModel
        // then sends info back to the page that called it.
        // parent::__construct();        
        
       $this->create_card();
    }
    
    // Registration function
    public function create_card()
    {
        // First set empty error and message arrays
        $error = array();
        $message = array();
        
        // This runs a series of checks to make sure that the post data
        // behaves properly
        if (isset($_POST['add']))
        {
            // Set an empty error
            $err = array();
            
            // Check to make sure we're on the right page
            // This one is category
            if ($_POST['add'] == 'card')
            {
                // Set the parameters
                
                // Check if the user_id is set
                if (isset($_POST['cs_id']))
                {
                    // Assign the post variable to user_id
                    $cs_id = Commons::filter_string($_POST['cs_id']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['cs_id'] = "No cardsort id, this shouldn't happen. Please try logging out and back in";
                }

                // Check if the cardsort_name is set
                if (isset($_POST['card_label']))
                {
                    $card_label = Commons::filter_string($_POST['card_label']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['card_label'] = "Please enter a label for your card";
                }

                // If the error array is empty, then begin processing
                if (empty($err))
                {
                    // Whenever we want to interact with a user, we need to instantiate a user object
                    // This is how you do that:
                    $card = new CardModel();
                    // Notice how (in the browser) there is nothing in this object.
                    // var_dump($user); // This is a very useful variable dump function that shows you what is in your variable

                    // This is how you assign values to the object
                    $card->cs_id = $cs_id; // ID of the cardsort
                    $card->card_label = $card_label; // Label of the category

                    // Now we can test the SQL for the category
                    // This is how you call a method (function) from within a class
                    $card->save();
                    
                    $message['completed'] = "yes";
                    $message['card_id'] = $card->id;
                    $message['card_label'] = $card->card_label;
                }
                // Otherwise there was an error in the post variables
                else
                {
                    // Set error equal to err
                    $error = $err;
                }
            }
            else
            {
                $error['post_type'] = "Wrong type of post!";
            }
        }
        else
        {
            $error['post'] = "Post not set";
        }
        // Return the data in an array
        $data_return = array(
            "error" => $error,
            "message" => $message
        );
        // JSON encode the data return array to make it easy to use
        echo json_encode($data_return);
    }   
}

$cardsort_card = new UxrCardController();