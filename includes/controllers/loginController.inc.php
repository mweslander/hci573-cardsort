<?php

class LoginController extends Basecontroller {

    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        //set variables before calling render
        $this->_pageTemplate->title = 'Login Page';
        $this->_pageTemplate->render('login', TRUE);
        
        AuthSession::setSession('loggedin', False);
        AuthSession::setSession('activated', FALSE);
    }

    public function login() 
    {

        $error = array();
        $message = array();
        
        
       
        //Check for POST Data
        if (isset($_POST)) 
        {

            // Set an empty error
            $err = array();

            // Set the parameters
            // Check if the username is set
            if (isset($_POST['login_name'])) 
            {
                // Assign the post variable to reg_user_name
                $log_name = Commons::filter_string($_POST['login_name']);
            } 
            else 
            {
                // Otherwise add an error to the array
                $err['log_name'] = "Please enter a username";
            }

            // Check if the password is set
            if (isset($_POST['login_user_password'])) 
            {
                $log_user_password = Commons::filter_string($_POST['login_user_password']);
            } 
            else 
            {
                // Otherwise add an error to the array
                $err['password'] = "Please enter a password";
            }

            // If the error array is empty, then begin processing

            if (empty($err)) 
            {
                //Call new user object
                $user = new UserModel();
                //Check if log_name is a email - return TRUE or FALSE
                $name = Commons::check_email($log_name);
                if ($name) 
                {
                    $user->user_email = $log_name;
                    $user->user_password = $log_user_password;

                    //Call userModel Login Method
                    $log_returned = $user->login();
                } 
                else 
                {
                    //log_name is a user name
                    $user->user_name = $log_name;
                    $user->user_password = $log_user_password;
                    //Call userModel Login Mthod
                    $log_returned = $user->login();
                }
                //var_dump($log_returned);
                
                
                // If the registration returned an error
                if (!empty($log_returned['error'])) 
                {
                    // Set the error to 
                    $error = $log_returned['error'];
                }
                // Otherwise if the registration returned a message
                elseif (!empty($log_returned['message'])) 
                {
                                       
                    if(!empty($log_returned['message']['activation']))
                    {
                        //redirect user to activation page
                        $this->_pageTemplate->title = 'Activation Page';
                        $this->_pageTemplate->render('/uxr/activation', TRUE);
                        //set session activated to false
                        AuthSession::setSession('loggedin', TRUE);
                        AuthSession::setSession('activated', FALSE);   
                    }
                    elseif(!empty($log_returned['message']['loggedin']))
                    {
                        //User is all ready activated
                        //redirect user to uxr secure page
                        
                        /***********************************
                        ****************Start SESSION go to SECURE PAGE *************
                        ***************************************/
                     AuthSession::setSession('loggedin', TRUE);
                     AuthSession::setSession('activated', TRUE);
  
                     header("location: ?url=uxr");  
                    }
                    
                    // Then print out the message
                    $message = $log_returned['message'];                    
                }
                // Otherwise if the registration didn't return anything
                else 
                {
                    // We have a big problem with the registration method
                    // Print this statement for our own debugging
                    $error['weird'] = "Something really weird happened. Sorry, try it again?";
                }
            }
            // Otherwise there was an error in the post variables
            else 
            {

                $error = $err;
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
    
    public function logout()
    {      
        AuthSession::destroySession();
        header('location: ?url='); 
    }
    
    public function activate(){
        $error = array();
        $message = array();
        
        if(isset($_POST['activate_av_code']) && !empty($_POST['activate_av_code'] ))
        {
            //call new user Model
            $user = new UserModel();
            //Set activate var in userModel
            $user->activation_code = $_POST['activate_av_code'];
            
            //return error or message from validateActivation
            //method in userModel
             $activate_returned = $user->validateActivation();
            
             // If the registration returned an error
                if (!empty($activate_returned['error'])) {
                    // Set the error to 
                    $error = $activate_returned['error'];
                }
                // Otherwise if the registration returned a message
                elseif (!empty($activate_returned['message'])) {
                    //set the message to
                    $message = $activate_returned['message'];
                    //User is now logged in and activated
                    //redirection to uxr page
                    
                    /***********************************
                    ****************TO DO *************
                    ***************************************/
                 //AuthSession::setSession('activated', TRUE); 
                 AuthSession::destroySession();  
                 header('location: ?url=');
                }
            
        }
        else 
        {
            //activation post had no data
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