<?php

/*
 * User Class
 * 
 * This class is designed to handle all of the database connections and such
 * that deal with users.
 * 
 * @author Michael Weslander
 */

class UserModel extends BaseModel 
{

    // Static Parameters
    protected static $table_name = 'usort_users';
    protected static $db_fields = array('id', 'user_name', 'user_password', 'user_role', 'user_email', 'first_name', 'last_name', 'activation_code', 'num_logins', 'last_login');
    // Public Parameters
    public $id; // Database key for usort_users
    public $user_name; // User username
    public $user_password; // User password
    public $user_role; // User Role (can be either visitor, uxr, or admin
    public $user_email; // User Email
    public $first_name; // User First Name
    public $last_name; // User Last Name
    public $activation_code; // Activation code (may or may not use this functionality)
    public $num_logins; // Number of logins
    public $last_login; // Last login
    
    // Construtor Method

    public function __construct() {
        // Instantiates Base
        parent::__construct();
    }

    // Register Method
    public function register() {
        // Set an empty error array
        $error = array();
        // Set an empty message array
        $message = array();
        // Set an empty variable
        $usr = false;
        // Set an empty variable
        $mail = false;

        // Check the user_name
        if (empty($this->user_name) || strlen($this->user_name) < 4) {
            // put an error in the array
            $error['user_name'] = "You must enter a longer username.";
        }
        // Otherwise the user_name is valid
        else {
            // Set usr to true
            $valid_user = $this->user_name;
            $usr = true;
        }

        // Check the password
        if (empty($this->user_password) || strlen($this->user_password) < 4) {
            // put an error in the array
            $error['password'] = "You must enter a longer password.";
        }
        // Password is a good length
        else {
            // Hash the password
            $hashed_pass = $this->_user_password_hash($this->user_password);
        }

        // Check to make sure the email isn't empty
        if (!empty($this->user_email)) {
            // Validate the email
            $valid_user_email = filter_var($this->user_email, FILTER_VALIDATE_EMAIL);
            // If the email validation is false
            if ($valid_user_email == false) {
                // Add error to array
                $error['email'] = "You must enter a vaild email.";
            } else {
                // Encrypt the email
                $encrypted_email = $this->_encrypt_email($this->user_email);
                // Set mail to true
                $mail = true;
            }
        }
        // Otherwise there was no email address
        else {
            // Add error to array
            $error['email'] = "You must enter an email address.";
        }


        if (($usr == true) && ($mail == true)) {
            // Check to see if the username or email already exists
            $check = $this->_check_user_name_email_input($valid_user, $encrypted_email);
            if ($check == false) {
                $error['duplicate'] = "Username or email already exists.";
            }
        }
        // Check to make sure the first name is at least 2 characters
        if (empty($this->first_name) || strlen($this->first_name) < 2) {
            $error['first_name'] = "You must enter a first name.";
        }
        // Check to make sure the last name is at least 2 characters
        if (empty($this->last_name) || strlen($this->last_name) < 2) {
            $error['last_name'] = "You must enter a last name.";
        }

        // If there were no errors in the checks above (the errors array is empty) 
        // then perform the next part
        if (empty($error)) {

            // Get a copy of $db_fields so we don't jack anything up
            $all_fields = static::$db_fields;
            // Get rid of the id by shifting the array
            array_shift($all_fields);
            // Get rid of the last login by popping the array
            array_pop($all_fields);
            // Get rid of the num_logins by popping the array
            array_pop($all_fields);
            // Then turn the array into a string in order to use it in our SQL statement
            $db_fields_list = implode(', ', $all_fields);

            // Prepare an array for binding parameters
            $reg_values = array($valid_user, $this->user_role, $this->first_name, $this->last_name);

            // Prepare the SQL statement
            $sql = "INSERT INTO " . static::$table_name . " (";
            $sql .= $db_fields_list;
            $sql .= ") VALUES (";
            $sql .= "?, "; // user_name
            $sql .= $hashed_pass . ", "; // Because of AES_ENCRYPT, don't prepare this
            $sql .= "?, "; // user_role
            $sql .= $encrypted_email . ", "; // Because of AES_ENCRYPT, don't prepare this
            $sql .= "?, "; // first_name
            $sql .= "?, "; // last_name
            $sql .= $this->activation_code . ")"; // This is an int and we generate it
            // Use the database connection to perform the query
            // Try connecting to the database
            try {
                // Prepare the sql 
                $prepared = $this->_db->prepare($sql);
                if ($prepared) {
                    $prepared->execute($reg_values);
                    $this->id = $this->_db->lastInsertId();
                    $message = "Registration Successful!";
                }
            }
            // If the connection with the create database script didn't work
            // Then throw an error
            catch (PDOException $e) {
                die("DB ERROR: " . $e->getMessage());
            }
        }
        // After everything 
        // Return the data in an array
        $data_return = array(
            "error" => $error,
            "message" => $message
        );
        return $data_return;
    }

    // Login Method
    public function login() {
        $error = array();

        $message = array();

        //find what the user has entered for name ie. user_name or user_email
        if (!empty($this->user_name)) {
            //check user name is empty and longer than 4 chars
            if (empty($this->user_name) || strlen($this->user_name) < 4) {
                // put an error in the array
                $error['user_name'] = "Your user name is in valid";
            } else {
                // Set usr to true
                $valid_user = $this->user_name;
            }
        } else {
            //check user name is empty and longer than 4 chars
            if (empty($this->user_email) || strlen($this->user_email) < 4) {
                // put an error in the array
                $error['user_email'] = "Your email is in valid";
            } else {
                // Set usr to true
                $valid_email = $this->user_email;
            }
        }

        //check password
        if (empty($this->user_password) || strlen($this->user_password) < 4) {
            // put an error in the array
            $error['user_password'] = "Password is invalid.";
        } else {
            // Hash the password
            $hashed_pass = $this->_user_password_hash($this->user_password);
        }

        //Is errors skip checking the database for valid user 
        if (empty($error)) {
            
            if (!empty($valid_email)) {
                //setup sql for prepared statment with valid email
                $emailEncrypt = $this->_encrypt_email($valid_email);
                $sql = "SELECT id, activation_code, num_logins
                FROM usort_users 
                WHERE user_email = $emailEncrypt
                AND user_password = $hashed_pass";
            } elseif (!empty($valid_user)) {
                //setup sql for prepared statment with valid email            
                $sql = "SELECT id, activation_code, num_logins 
                FROM usort_users 
                WHERE user_name = '" . $valid_user . "' 
                AND user_password = $hashed_pass";
            }

            //Prepare Statement 
            $stmt = $this->_db->prepare($sql);             
            //Execute Statement
            $stmt->execute();
            //Get row count 1 if user exist 0 if no user found
            $rows = $stmt->rowCount();
            if($rows == 1){
                //set message - user has logged in successfull
                $message['loggedin'] = 'You have successfully logged in';
                //Turn the reults into a key value array
                $vars = $stmt->fetchAll();
                //Creat an array of just the column names and values
                // that were returned from the database
                foreach ($vars as $key => $value) {
                    foreach ($value as $key1 => $value1) {
                        $data[$key1] = $value1;
                    }
                }
                //Check if this is the users first time logging in.
                if($data['num_logins'] <! 0){
                    //User has never loggedin, check activation key
                    
                    $message['activation'] = 'You still need to activate your account';
                    
                }else{
                    
                    //Increment Login count
                    $new_login = intval($data['num_logins'] + 1);   
                    //Set user id to $id
                    $id = $data['id'];
                    //Update table usort_users 
                    //with users num_logins and last_login
                    $sql2 = "UPDATE usort_users
                            SET num_logins = :nl
                            WHERE id = :id";
                    
                    //Prepare Statement 
                    $stmt = $this->_db->prepare($sql2);  
                    $stmt->bindParam(':nl',$new_login);
                    $stmt->bindParam(':id',$id);
                    //Execute Statement
                    $stmt->execute();
                    
                    $message['loggedin'] = 'Glad to see you again';
                    //pull id into session
                    $message['id'] = $id;
                }
             
            }else{
                $error = 'Your name or password is incorrect.';
            }           
            
        }

        // After everything 
        // Return the data in an array
        $data_return = array(
            "error" => $error,
            "message" => $message
        );
        return $data_return;
    }

    public function validateActivation(){
        
        
        $error = array();

        $message = array();
        
        //check user name is empty and longer than 4 chars
        if (empty($this->activation_code)) {
            // put an error in the array
            $error['activation_code'] = "This is not a valid activation code";
        } else {
            // Set usr to true
            $valid_av_code = $this->activation_code;
            
        }
        //Assuming AV CODE WILL ALWAYS BE UNIQUIC
        //IF NOT WE NEED TO PULL IN THE USER NAME FROM SESSION
              
        //check if av_code match in database
        $sql = "SELECT id, num_logins FROM usort_users
                WHERE activation_code = :avCode";
        $stmt = $this->_db->prepare($sql);
        //bindparams
        $stmt->bindParam(':avCode', $valid_av_code);
        //execute statement
        $stmt->execute();
        //Get row count from sql query
        $rows = $stmt->rowCount();
        
        if($rows == 1){
          
            //TESTING echo "activation code matched, updated num_logins";
            
                    $vars = $stmt->fetchAll();
                    //Creat an array of just the column names and values
                    // that were returned from the database
                    foreach ($vars as $key => $value) {
                        foreach ($value as $key1 => $value1) {
                            $data[$key1] = $value1;
                        }
                    }
                    
                    //Increment Login count
                    $new_login = intval($data['num_logins'] + 1);   
                    //Set user id to $id
                    $id = $data['id'];
                    //Update table usort_users 
                    //with users num_logins and last_login
                    $sql2 = "UPDATE usort_users
                            SET num_logins = :nl
                            WHERE id = :id";
                    
                    //Prepare Statement 
                    $stmt = $this->_db->prepare($sql2);  
                    $stmt->bindParam(':nl',$new_login);
                    $stmt->bindParam(':id',$id);
                    //Execute Statement
                    $stmt->execute();
                    
                    //set message
                    
                    $message['activation'] = 'Congrates you have activated your account';
                   
        }else{
            $error = 'Activation Code is not Correct!';
        }
        
        
        // After everything 
        // Return the data in an array
        $data_return = array(
            "error" => $error,
            "message" => $message
        );
        return $data_return;
        
    }

    // Password Hashing
    private function _user_password_hash($password) {
        // SHA the MD5
        $hashed_md5 = sha1(md5($password));
        // Then MD5 the SHA
        $hashed_sha = md5(sha1($hashed_md5));
        // Then encrypt using AES and the salt from includes/constants/sql.inc
        return "AES_ENCRYPT('" . $hashed_sha . "', '" . USER_PWD_SALT . "')";
    }

    // Email Encryption
    private function _encrypt_email($email) {
        // Encrypt using AES and the salt from includes/constants/sql.inc
        return "AES_ENCRYPT('" . $email . "', '" . USER_EMAIL_SALT . "')";
    }

    // Email Encryption
    private function _decrypt_email($email) {
        // Encrypt using AES and the salt from includes/constants/sql.inc
        return "AES_DECRYPT('" . $email . "', '" . USER_EMAIL_SALT . "')";
    }

    // Check user_name and email for duplicates
    // Check whether the user row exists
    private function _check_user_name_email_input($valid_user, $encrypted_email) {
        $sql = "SELECT user_name, user_email FROM " . static::$table_name;
        $sql .= " WHERE user_name = ?";
        $sql .= " OR user_email = " . $encrypted_email;

        // Use the database connection to perform the query
        // Try connecting to the database
        try {
            // This prepares the sql for the query
            $prepared = $this->_db->prepare($sql);
            // If this worked
            if ($prepared) {
                // Execute the statement
                $prepared->execute(array($valid_user));
                // Get the row count
                $results = $prepared->rowCount();
                // If any rows are returned ( ie >0 )
                if ($results > 0) {
                    // Then return false
                    return false;
                }
                // Otherwise this is a unique row
                else {
                    // return true
                    return true;
                }
            }
        }
        // If the connection with the create database script didn't work
        catch (PDOException $e) {
            // Then throw an error
            die("DB ERROR: " . $e->getMessage());
        }
    }

}