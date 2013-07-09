<?php

/*
 * UxrStudyController class
 * 
 * This class handles AJAX calls for selecting specific studies
 * It returns html to populate the #uxrView div on the 
 * home.inc.php page in the views
 * 
 * @author Michael Weslander
 */

// This is how the classes are being called 
// Only instead of writing all of this out, Brett wrote an autoloader
// that goes through and fetches them for us
require_once '../constants/paths.inc.php';
require_once (CONST_PATH . 'sql.inc.php');
require_once (CLASS_PATH . 'database.inc.php');
require_once (CLASS_PATH . 'authSession.inc.php');
require_once (CLASS_PATH . 'commons.inc.php');
require_once (MODEL_PATH . 'baseModel.inc.php');
require_once (MODEL_PATH . 'CardSortModel.inc.php');
require_once (MODEL_PATH . 'CardModel.inc.php');
require_once (MODEL_PATH . 'CategoryModel.inc.php');
require_once (CTRL_PATH . 'baseController.inc.php');

class UxrStudyController extends Basecontroller
{
    public function __construct() 
    {      
       $this->study_handling();
    }
    
    // This is our main switchboard function
    // It gets called when the class is initiated
    public function study_handling()
    {
        // Initialize the session
        AuthSession::initSession();
        // This runs a series of checks to make sure that the post data
        // behaves properly
        if (isset($_POST['view']))
        {
            $this->_view_study();
        }
        elseif (isset($_POST['edit']))
        {
            $this->_edit_study();
        }
        elseif (isset($_POST['delete']))
        {
            $this->_delete_study();
        }
        else
        {
            echo "Error with the post!";
        }   
    }
    
    // View Study Method
    private function _view_study()
    {
        // First set empty error array
        $error = array();

        //Get user id from Session 
        $user_id = AuthSession::getSession('uid');
        
        if (isset($_POST['cs_id']))
        {
            // Set the cs_id to something more usable
            $cs_id = $_POST['cs_id'];
            // Initiate the cardsort
            $cardsort = CardsortModel::find_by_id($cs_id);
        }
        else
        {
            $error['cs_id'] = "There is no Cardsort ID";
        }
        
        if (empty($error))
        {
            // If the cardsort type is closed
            if ($cardsort->cs_type == 'closed')
            {
                // Get all of the categories
                $categories = CategoryModel::find_all_by_cs_id($cardsort->id);
            } // Otherwise the cardsort type is open

            // Get the Cards for the selected study
            $cards = CardModel::find_all_by_cs_id($cardsort->id);
            
            if(isset($cards))
            {  
                echo "<ul class='sortable' class='droptrue'>";
                foreach ($cards as $card) 
                {                        
                    echo "<li class='ui-state-default'>$card->card_label</li>";                        
                }
                echo '</ul>';
            }
            
            if(isset($categories))
            {
                foreach ($categories as $category)
                {
                    echo "<ul class='sortable sortableCol' class='dropfalse'>";    
                    echo "<li class='ui-state-highlight'>$category->cat_label</li>"; 
                    echo '</ul>';
                }
            }
        }
        else
        {
            foreach ($error as $err)
            {
                echo $err;
            }
        }
        
    }
    
    // Edit Study Method
    
    // Delete Study Method
}

$study = new UxrStudyController();