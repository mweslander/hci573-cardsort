<?php



class Homemodel extends Basemodel{
    
    
    public function __construct() {
        parent::__construct();
    }
   
    public function user_infor(){  
        echo "inside Model";
    return array(
        'first' => 'Brett',
        'middel' => 'Scott',
        'last' => 'Young',
        );   
    }
    
    
}
