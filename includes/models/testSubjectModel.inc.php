<?php

/*
 * Test Subject Class
 * 
 * This class handles all the database saving and retrieval for the cardsort cards
 * 
 * @author Michael Weslander
 */

class TestSubjectModel extends BaseModel
{
    // Static Parameters
    protected static $table_name = 'usort_test_subjects';
    protected static $db_fields = array('id', 'cs_id', 'ts_email');
    
    // Public Parameters
    public $id; // Database Key for usort_cards
    public $cs_id; // Cardsort ID
    public $ts_email; // Test subject email address

    // Construtor Method
    public function __construct() 
    {
        // Instantiates BaseModel
        parent::__construct();
    }
    
    // Create Method
    
    // Update Method
    
    // Delete Method
    
    
    // This method creates a new Test Subject
    public function saveTS(){
        
            $encryptEmail = "AES_ENCRYPT('" . $this->ts_email . "', '" . USER_EMAIL_SALT . "')";
            $sql = "INSERT INTO " . static::$table_name . "(cs_id, ts_email)
                VALUES ($this->cs_id, $encryptEmail )";
            try 
            {
                $stmt = $this->_db->prepare($sql);
                if($stmt)
                {
                    $stmt->execute();
                    $this->id = $this->_db->lastInsertId();
                }
            }
            // If the connection with the create database script didn't work
            // Then throw an error
            catch (PDOException $e) {
                die("DB ERROR: " . $e->getMessage());
            }
    }



    // This method check if the user has already been created
    // Returns true or false
    public function check_if_ts_user_exists($cs_id, $ts_email)
    {

                
//        $sql = "SELECT id, cs_id, AES_DECRYPT(ts_email,'" . USER_EMAIL_SALT . "') as ts_email
//                FROM " . static::$table_name . " WHERE cs_id = $cs_id 
//                AND ts_email = AES_ENCRYPT('".$ts_email. "','". USER_EMAIL_SALT ."')";
        $sql = "SELECT COUNT(*)
                FROM " . static::$table_name . " WHERE cs_id = $cs_id 
                AND ts_email = AES_ENCRYPT('".$ts_email. "','". USER_EMAIL_SALT ."')";
        // var_dump($sql);
        try 
        {
            $stmt = $this->_db->prepare($sql);
            if($stmt)
            {
                $stmt->execute();
                if ($stmt->fetchColumn() > 0)
                {
                    // Then we have a user and they need to enter a new email addree
                    // or something
                    return true;
                }
                else
                {

                    return false;
                }
            }
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}