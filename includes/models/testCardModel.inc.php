<?php

/*
 * Test Card Class
 * 
 * This class handles all the database saving and retrieval for the cards that
 * are used in any specific test.
 * 
 * @author Michael Weslander
 */

class TestCardModel extends BaseModel
{
    // Static Parameters
    protected static $table_name = 'usort_test_cards';
    protected static $db_fields = array('id', 'test_id', 'card_id', 'test_category');
    
    // Public Parameters
    public $id; // Database Key for usort_test_cards
    public $test_id; // Test ID (from tests table)
    public $card_id; // Card ID (from cards table)
    public $test_category; // Category of the card (VARCHAR)

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