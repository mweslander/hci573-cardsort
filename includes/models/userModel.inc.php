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
    public function __construct() 
    {
        // Instantiates Base
        parent::__construct();
    }
    
    // Register Method
    public function register()
    {
        // Hash the password
        $hashed_pass = $this->_user_password_hash($this->user_password);
        // Encrypt the email
        $encrypted_email = $this->_encrypt_email($this->user_email);
        
        // Get a copy of $db_fields so we don't jack anything up
        $all_fields = static::$db_fields;
        // Get rid of the id by shifting the array
        array_shift($all_fields);
        // Get rid of the last login by popping the array
        array_pop($all_fields);
        // Get rid of the num_logins by popping the array
        array_pop($all_fields);
        // Then turn the array into a string in order to use it in our SQL statement
        $db_fields_list = implode(', ', $all_fields );
        
        // SQL for inserting a new user into the database
        $sql  = "INSERT INTO " . static::$table_name . " (";
        $sql .= $db_fields_list;
        $sql .= ") VALUES ('";
        $sql .= $this->user_name . "', "; // Because of AES_ENCRYPT, don't add single quotes
        $sql .= $hashed_pass . ", '";
        $sql .= $this->user_role . "', "; // Because of AES_ENCRYPT, don't add single quotes
        $sql .= $encrypted_email . ", '";
        $sql .= $this->first_name . "', '";
        $sql .= $this->last_name . "', ";
        $sql .= $this->activation_code . ")";
        // If the query works, then return the id and true
        var_dump($sql);
        
        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // Prepare the sql 
            $prepared = $this->_db->prepare($sql);
            if ($prepared)
            {
                $prepared->execute(); 
                $this->id = $prepared->lastInsertId();
                return true;
            }
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    // Login Method
    
    
    // Password Hashing
    private function _user_password_hash($password)
    {
        // SHA the MD5
        $hashed_md5 = sha1(md5($password));
        // Then MD5 the SHA
        $hashed_sha = md5(sha1($hashed_md5));
        // Then encrypt using AES and the salt from includes/constants/sql.inc
        return "AES_ENCRYPT('" . $hashed_sha ."', '" . USER_PWD_SALT . "')";
    }
    
    // Email Encryption
    private function _encrypt_email($email)
    {
        // Encrypt using AES and the salt from includes/constants/sql.inc
        return "AES_ENCRYPT('" . $email ."', '" . USER_EMAIL_SALT . "')";
    }
    
    
}