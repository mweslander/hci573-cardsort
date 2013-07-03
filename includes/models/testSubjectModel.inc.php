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
    
}