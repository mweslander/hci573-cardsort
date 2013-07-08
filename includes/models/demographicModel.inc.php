<?php

/*
 * Demographic Class
 * 
 * This class handles all the database saving and retrieval for the cardsort
 * demographics as specified by the uxr
 * 
 * @author Michael Weslander
 */

class DemographicModel extends BaseModel
{
    // Static Parameters
    protected static $table_name = 'usort_dmgs';
    protected static $db_fields = array('id', 'cs_id', 'dmg_label', 'dmg_type');
    
    // Public Parameters
    public $id; // Database key for usort_dmgs
    public $cs_id; // Cardsort ID
    public $dmg_label; // Demographics Label (ex birthday, gender, income)
    public $dmg_type; // Demographics type, either string, int or date

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