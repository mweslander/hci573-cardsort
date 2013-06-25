<?php


class Membermodel extends Basemodel{
   
    public function __construct() {
        parent::__construct();
    }
    
    public function getUserName(){
        $username = auth::getSession('username');
        if(isset($username)){
            return $username ;
           
        }
    }
     public function getEmail(){
       $username = auth::getSession('username');
        if(isset($username)){
            //query database - get profile of useername
            
            $stmt = $this->_db->prepare("SELECT user_email From hci_bsyoung WHERE user_name = :un");
            $stmt->bindParam(':un',$username);
            $stmt->execute();
            
            $results = $stmt->fetchAll();
            return $results[0]; 
           
        }
    }
   
}