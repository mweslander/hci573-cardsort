<?php

/*
 * Cardsort Class
 * 
 * This class handles all the database saving and retrieval for the cardsorts
 * 
 * @author Michael Weslander
 */

class CardsortModel extends BaseModel
{
    // Static Parameters
    protected static $table_name = 'usort_cardsorts';
    protected static $db_fields = array('id', 'user_id', 'cs_name', 'cs_type', 'cs_password', 'cs_created');
    
    // Public Parameters
    public $id; // Database key for usort_cardsorts
    public $user_id; // User ID
    public $cs_name; // Cardsort Name
    public $cs_type; // Cardsort Type
    public $cs_password; // Cardsort Password (optional)
    public $cs_created; // Date & time Cardsort was created

    // Construtor Method
    public function __construct() 
    {
        // Instantiates BaseModel
        parent::__construct();
    }
    
    // These are inherited from BaseModel
    
    // Save Method
    
    // Create Method
    
    // Update Method
    
    // Delete Method
    
    public function list_of_study(){
        
        $stmt = $this->_db->prepare("SELECT * FROM usort_cardsorts
                                            WHERE user_id = :uid");
        $stmt->bindParam(':uid', $this->user_id);
        $stmt->execute();
        $list = $stmt->fetchAll();
        return $list;
        
        
    }
    
    
}