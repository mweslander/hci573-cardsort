<?php

/*
 * RegisterController class
 * 
 * This class handles AJAX calls for registration
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
require_once (MODEL_PATH . 'CardsortModel.inc.php');
require_once (CTRL_PATH . 'baseController.inc.php');

class UxrCardsortController extends Basecontroller
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
        
       $this->create_cardsort();
    }
    
    // Registration function
    public function create_cardsort()
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
            // This one is cardsort
            if ($_POST['add'] == 'cardsort')
            {
                // Set the parameters
                
                // Check if the user_id is set
                if (isset($_POST['user_id']))
                {
                    // Assign the post variable to user_id
                    $user_id = Commons::filter_string($_POST['user_id']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['user_id'] = "No user_id, this shouldn't happen. Please try logging out and back in";
                }

                // Check if the cardsort_name is set
                if (isset($_POST['cardsort_name']))
                {
                    $cardsort_name = Commons::filter_string($_POST['cardsort_name']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['cardsort_name'] = "Please enter a name for your cardsort";
                }

                // Check if the cardsort_type is set
                if (isset($_POST['cardsort_type']))
                {
                    $cardsort_type = Commons::filter_string($_POST['cardsort_type']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['cardsort_type'] = "This shouldn't happen, but please select a cardsort type";
                }

                // Check if the password is set
                if (isset($_POST['password']))
                {
                    $password = Commons::filter_string($_POST['password']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $password = NULL;
                }

                // If the error array is empty, then begin processing
                if (empty($err))
                {
                    // Whenever we want to interact with a user, we need to instantiate a user object
                    // This is how you do that:
                    $cardsort = new CardsortModel();
                    // Notice how (in the browser) there is nothing in this object.
                    // var_dump($user); // This is a very useful variable dump function that shows you what is in your variable

                    // Check to see if the cardsort id is set
                    if (isset($_POST['cs_id']))
                    {
                        // Assign the post variable to reg_user_name
                        $cardsort->id = Commons::filter_string($_POST['cs_id']);
                    }
                    
                    // This is how you assign values to the object
                    $cardsort->user_id = $user_id; // User id of the UXR who created the cardsort
                    $cardsort->cs_name = $cardsort_name; // Name of the cardsort
                    $cardsort->cs_type = $cardsort_type; // type of the cardsort
                    $cardsort->cs_password = $password; // Password, NULL if not selected by user (optional)

                    // This time when we "dump" the variable, notice how the same user object we instantiated
                    // before now has properties! Once these properties are added to the user object
                    // we can use them.
                    // var_dump($user);

                    // Now we can test the registration SQL for the user
                    // This is how you call a method (function) from within a class
                    $cardsort->save();
                    
                    $message['completed'] = "yes";
                    $message['cs_id'] = $cardsort->id;
                    $message['cs_name'] = $cardsort->cs_name;
                    $message['cs_type'] = $cardsort->cs_type;
                    $message['cs_password'] = $cardsort->cs_password;
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

$uxr_cardsort = new UxrCardsortController();