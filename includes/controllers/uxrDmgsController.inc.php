<?php

/*
 * UxrDmgsController class
 * 
 * This class handles AJAX calls for demographics for a specific cardsort
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
require_once (MODEL_PATH . 'demographicModel.inc.php');
require_once (CTRL_PATH . 'baseController.inc.php');

class UxrDmgsController extends Basecontroller
{
    private $_model = 'DemographicModel';
    
    public function __construct() {
        // I don't think we really need to construct the Basecontroller here
        // We may not even need to extend the Basecontroller
        // The Basecontroller is creating a new page template, and this
        // particular page doesn't need a template per-se, or it might, I'm not
        // exactly sure. Basically I will be running a function that checks the
        // post data, sends it to the UserModel, gets info from the UserModel
        // then sends info back to the page that called it.
        // parent::__construct();        
        
       $this->demographic_handling();
    }
    
    public function demographic_handling()
    {
        // This runs a series of checks to make sure that the post data
        // behaves properly
        if (isset($_POST['add']))
        {
            $this->create_demographic();
        }
        elseif (isset($_POST['delete']))
        {
            $this->delete_demographic();
        }
        elseif (isset($_POST['rows']))
        {
            $this->retrieve_rows();
        }
    }
    
    // Registration function
    public function create_demographic()
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
            if ($_POST['add'] == 'demographic')
            {
                // Set the parameters
                
                // Check if the cs_id is set
                if (isset($_POST['cs_id']))
                {
                    // Assign the post variable to cs_id
                    $cs_id = Commons::filter_string($_POST['cs_id']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['cs_id'] = "No cardsort id, this shouldn't happen. Please try logging out and back in";
                }

                // Check if the dmgs_label is set
                if (isset($_POST['dmgs_label']))
                {
                    $dmg_label = Commons::filter_string($_POST['dmgs_label']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['dmgs_label'] = "Please enter a label for your demographic value";
                }

                // Check if the cardsort_name is set
                if (isset($_POST['dmgs_type']))
                {
                    $dmg_type = Commons::filter_string($_POST['dmgs_type']);
                }
                else
                {
                    // Otherwise add an error to the array
                    $err['dmgs_type'] = "This shouldn't happen, but please select a type for your demographic value";
                }
                
                // If the error array is empty, then begin processing
                if (empty($err))
                {
                    // Whenever we want to interact with a user, we need to instantiate a user object
                    // This is how you do that:
                    $dmg = new DemographicModel();
                    // Notice how (in the browser) there is nothing in this object.
                    // var_dump($user); // This is a very useful variable dump function that shows you what is in your variable

                    // This is how you assign values to the object
                    $dmg->cs_id = $cs_id; // ID of the cardsort
                    $dmg->dmg_label = $dmg_label; // Label of the category
                    $dmg->dmg_type = $dmg_type;

                    // Now we can test the SQL for the category
                    // This is how you call a method (function) from within a class
                    $dmg->save();
                    
                    $message['completed'] = "yes";
                    $message['dmg_id'] = $dmg->id;
                    $message['dmg_label'] = $dmg->dmg_label;
                    $message['dmg_type'] = $dmg->dmg_type;
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
    
    public function delete_demographic()
    {
        // First set empty error and message arrays
        $error = array();
        $message = array();
        
        // This runs a series of checks to make sure that the post data
        // behaves properly
        if (isset($_POST['delete']))
        {
            // If the post ID is set
            if($_POST['id'])
            {
                // Then make the id variable == to the post
                $id = $_POST['id'];
                // And then use the time class to delete the row from the database
                $dmg = new DemographicModel();
                $dmg->id = $id;
                
                if ($dmg->delete())
                {
                    $message['deleted'] = "yes";
                }
                else
                {
                    $error['database'] = "Deletion was not completed";
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
    
    public function retrieve_rows()
    {
        // First set empty error and message arrays
        $error = array();
        $message = array();

        // Check if the cs_id is set
        if (isset($_POST['cs_id']))
        {
            // Assign the post variable to cs_id
            $cs_id = Commons::filter_string($_POST['cs_id']);
        }
        else
        {
            // Otherwise add an error to the array
            $err['cs_id'] = "No cardsort id, this shouldn't happen. Please try logging out and back in";
        }

        // If the error array is empty, then begin processing
        if (empty($err))
        {
            // Find all the rows for this user in the dmgs table in the database
            $dmgs = DemographicModel::find_all_by_cs_id($cs_id);
            
            // Then for each time
            foreach ($dmgs as $dmg)
            {
                $dmg_array = array();
                
                $dmg_array['id'] = $dmg->id;
                $dmg_array['dmg_label'] = $dmg->dmg_label;
                $dmg_array['dmg_type'] = $dmg->dmg_type;
                
                // Pass this back to the page
                $message[] = $dmg_array;
            }
        }
        // Otherwise there was an error in the post variables
        else
        {
            // Set error equal to err
            $error = $err;
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

$cardsort_dmg = new UxrDmgsController();