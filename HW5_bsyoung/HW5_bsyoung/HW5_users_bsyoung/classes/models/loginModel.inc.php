<?php


class Loginmodel extends Basemodel{
   
    public function __construct() {
        parent::__construct();
    }
    
    public function logins(){
        
        $login = mysql_real_escape_string($_POST['txtLoginName']);
        $password = $this->_cmmsFunc->hash_pass(mysql_real_escape_string($_POST['pssLoginPass']));
      
        
        
        $stmt = $this->_db->prepare("SELECT uid FROM hci_bsyoung 
                            WHERE user_name = :un AND user_pass = :up");
        $stmt->bindParam(':un',$login);
        $stmt->bindParam(':up', $password);        
        $stmt->execute();
        
        $results = $stmt->rowCount();
        //echo $results;
        if($results > 0){
            //
            //auth::initSession();
            auth::setSession('loggedin', TRUE);            
            auth::setSession('username', $login);
            
         
            //inset timestamp of user login into database table users_bsyoung
            $stmt = $this->_db->prepare("INSERT INTO users_bsyoung (
                                            uid,
                                            last_login,
                                            ip
                                            ) VALUES (:uid,NOW(),:ip)");
                
                $stmt->bindParam(':uid', $login);                                         
                $stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);     
                $stmt->execute();
            
            header('Location: ../member');
            
        }else{
            //error - username password does exist or wrong
            header('Location: ../login');
        }
        
        
    }
   
}