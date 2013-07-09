<?php

/*
 * Card Class
 * 
 * This class handles all the database saving and retrieval for the cardsort cards
 * 
 * @author Michael Weslander
 */

class CardModel extends BaseModel
{
    // Static Parameters
    protected static $table_name = 'usort_cards';
    protected static $db_fields = array('id', 'cs_id', 'card_label');
    
    // Public Parameters
    public $id; // Database Key for usort_cards
    public $cs_id; // Cardsort ID
    public $card_label; // Label of the card

    // Construtor Method
    public function __construct() 
    {
        // Instantiates BaseModel
        parent::__construct();
    }
    
    // Create Method
    
    // Update Method
    
    // Delete Method
    
    public function list_cards_by_study(){
        
        $stmt = $this->_db->prepare("SELECT * FROM usort_cards
                                            WHERE cs_id = :csid");
        $stmt->bindParam(':csid', $this->cs_id);
        $stmt->execute();
        $list = $stmt->fetchAll();
        return $list;
    }
        
    
}