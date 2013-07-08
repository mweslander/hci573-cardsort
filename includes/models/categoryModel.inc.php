<?php

/*
 * Category Class
 * 
 * This class handles all the database saving and retrieval for the cardsort categories
 * 
 * @author Michael Weslander
 */

class CategoryModel extends BaseModel
{
    // Static Parameters
    protected static $table_name = 'usort_categories';
    protected static $db_fields = array('id', 'cs_id', 'cat_label');
    
    // Public Parameters
    public $id; // Database key for usort_categories
    public $cs_id; // Cardsort ID
    public $cat_label; // Category label

    // Construtor Method
    public function __construct() 
    {
        // Instantiates Base
        parent::__construct();
    }
    
    // Uses methods from the BaseModel
    
    // Create Method
    
    // Update Method
    
}