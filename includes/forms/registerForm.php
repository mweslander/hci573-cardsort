<?php
/*
 * This is the register form php page for AJAX
 * 
 */


// This is how the classes are being called 
// Only instead of writing all of this out, Brett wrote an autoloader
// that goes through and fetches them for us
require_once '../constants/paths.inc.php';
require_once (CONST_PATH . 'sql.inc.php');
require_once (CLASS_PATH . 'database.inc.php');
require_once (CLASS_PATH . 'commons.inc.php');
require_once (MODEL_PATH . 'baseModel.inc.php');
require_once (MODEL_PATH . 'userModel.inc.php');

/*
 * THIS IS HOW TO REGISTER A NEW USER
 * make sure you run the installation before using this script
 * get rid of the var_dumps on lines 52 & 67 to use on a page
 * 
*/

// This runs a series of checks to make sure that the post data
// behaves properly
if (isset($_POST))
{
    // Set an empty error
    $err = array();
    
    // Set the parameters
    
    // Check if the username is set
    if (isset($_POST['register_user_name']))
    {
        // Assign the post variable to reg_user_name
        $reg_user_name = Commons::filter_string($_POST['register_user_name']);
    }
    else
    {
        // Otherwise add an error to the array
        $err['user_name'] = "Please enter a username";
    }
    
    // Check if the password is set
    if (isset($_POST['register_password']))
    {
        $reg_user_password = Commons::filter_string($_POST['register_password']);
    }
    else
    {
        // Otherwise add an error to the array
        $err['password'] = "Please enter a password";
    }
    
    // Check if the email is set
    if (isset($_POST['register_email']))
    {
        $reg_user_email = Commons::filter_string($_POST['register_email']);
    }
    else
    {
        // Otherwise add an error to the array
        $err['email'] = "Please enter an email address";
    }

    // Check if the first name is set
    if (isset($_POST['register_first_name']))
    {
        $reg_user_first_name = Commons::filter_string($_POST['register_first_name']);
    }
    else
    {
        // Otherwise add an error to the array
        $err['first_name'] = "Please enter a first name";
    }
    
    // Check if the last name is set
    if (isset($_POST['register_last_name']))
    {
        $reg_user_last_name = Commons::filter_string($_POST['register_last_name']);
    }
    else
    {
        // Otherwise add an error to the array
        $err['last_name'] = "Please enter a last name";
    }
    
    // If the error array is empty, then begin processing
    if (empty($err))
    {
        // Whenever we want to interact with a user, we need to instantiate a user object
        // This is how you do that:
        $user = new UserModel();
        // Notice how (in the browser) there is nothing in this object.
        // var_dump($user); // This is a very useful variable dump function that shows you what is in your variable

        // This is how you assign values to the object
        $user->user_name = $reg_user_name;
        $user->user_password = $reg_user_password;
        $user->user_role = "uxr";
        $user->user_email = $reg_user_email;
        $user->first_name = $reg_user_first_name;
        $user->last_name = $reg_user_last_name;
        $user->activation_code = rand(1000,9999);
        // This time when we "dump" the variable, notice how the same user object we instantiated
        // before now has properties! Once these properties are added to the user object
        // we can use them.
        // var_dump($user);

        // Now we can test the registration SQL for the user
        // This is how you call a method (function) from within a class
        $reg_returned = $user->register();

        // If the registration returned an error
        if (!empty($reg_returned['error']))
        {
            // Then loop through the multi-dimensional array
            foreach ($reg_returned['error'] as $key=>$value)
            {
                // And echo the error and value
                echo $key . " : " . $value;
            }
        }
        // Otherwise if the registration returned a message
        elseif (!empty($reg_returned['message']))
        {
            // Then print out the message
            echo $reg_returned['message'];
        }
        // Otherwise if the registration didn't return anything
        else
        {
            // We have a big problem with the registration method
            // Print this statement for our own debugging
            echo "Something really weird happened. Sorry, try it again?";
        }
    }
    // Otherwise there was an error in the post variables
    else
    {
        // Loop through the err array
        foreach ($err as $key=>$value)
        {
            // And echo the key and value
            echo $key . " : " . $value . "<br>";
        }
    }
}
else
{
    echo "Post not set";
}



/*
 * THIS IS THE END OF THE USER REGISTRATION
 */