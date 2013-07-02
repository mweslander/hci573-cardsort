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
    
    // Login Method
    
}