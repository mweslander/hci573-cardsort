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
    
    public function list_categorys_by_study(){
        
        $stmt = $this->_db->prepare("SELECT * FROM usort_categories
                                            WHERE cs_id = :ctid");
        $stmt->bindParam(':ctid', $this->cs_id);
        $stmt->execute();
        $list = $stmt->fetchAll();
        return $list;
    }
}