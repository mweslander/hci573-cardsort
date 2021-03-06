<?php

/*
 * Test Demographics Int Type Class
 * 
 * This class handles all the database saving and retrieval for the demographics 
 * that use int as their type.
 * 
 * @author Michael Weslander
 */

class TestDmgIntModel extends TestDmgModel
{
    // Static Parameters
    protected static $table_name = 'usort_test_dmg_ints';
    protected static $db_fields = array('id', 'test_id', 'dmg_id', 'dmg_value');
    
    // Public Parameters
    public $id; // Database Key for usort_cards
    public $cs_id; // Cardsort ID
    public $dmg_id; // ID of the uxr defined demographic
    public $dmg_value; // Value of the Demographic (INTEGER)

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