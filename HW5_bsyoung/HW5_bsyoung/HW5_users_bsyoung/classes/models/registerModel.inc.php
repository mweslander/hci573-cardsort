<?php


class Registermodel extends Basemodel{
    
    protected $err = array();
    
    
    public function __construct() {
        parent::__construct();
       
    }
    
    public function register(){
        //echo "this is reg model";
        $username = null;
        $email = null;
        $password = null;
        $passwordCF = null;
        $salt = "brettsalt";
        $this->_error->setError("test", "testing");
        
        
        if(empty($_POST)){
            $err[] = "Required fields must be filled out";
            
           
        }
        
        $username = mysql_real_escape_string($_POST['txtLoginName']);
	$email = mysql_real_escape_string($_POST['txtLoginEmail']);
	$password = mysql_real_escape_string($_POST['pssLoginPass']);
	$passwordCF = mysql_real_escape_string($_POST['pssLoginCFPass']); //Check password matches
	
	$member_date = date('Y-m-d');
	$user_ip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
	$activation_code = rand(1000,9999);

	if(empty($username) || strlen($username) < 4)
	{
		$err[] = "username You must enter your username";
                
	}
	if(empty($email) || strlen($email) < 4)
	{
		$err[] = "You must enter an email";
	}
	if(empty($password) || strlen($password) < 4)
	{
            if($password !== $passwordCF){
		$err[] = "Your passwords must match";
            }else{
                $err[] = "You must enter a password";
            }    
	}
	if(empty($email) || !$this->_cmmsFunc->check_email($email))
	{
		$err[] = "Please enter a valid email address.";
	}
        
        $stmt = $this->_db->prepare("SELECT user_name FROM hci_bsyoung WHERE user_name = :un ");
        $stmt->bindParam(':un',$username);             
        $stmt->execute();
        
        $results = $stmt->rowCount();
        //echo $results;
        if($results > 0){
            $err[] = "User already exists";
            echo "User";
           // header('Location: ../Login');
        }else{
            
        }
        
        if(empty($err))
	{
		$password = $this->_cmmsFunc->hash_pass($password);
                
                $stmt = $this->_db->prepare("INSERT INTO hci_bsyoung (
                                            user_name,
                                            user_email,
                                            user_pass,
                                            activation_code,
                                            member_date
                                            ) VALUES (:un, :em,:pss,:ac,:md)");
                
                $stmt->bindParam(':un', $username);
                $stmt->bindParam(':em', $email);
                $stmt->bindParam(':pss', $password);
                $stmt->bindParam(':ac',$activation_code);
                $stmt->bindParam(':md',$member_date);
               
                        
                $stmt->execute();
                
                
		//Tell user registration worked
		$msg = "Registration successful!";
                
                header('location: ../login');
        }else{
               
                
                $err[] = "You have not registered";
                header('location: ../register');
                 
        }
       
        
    }
    public function getError(){
        
        $this->_error->setError("test", "testing");     
        $results = $this->_error->getError();
        return $results;
    }
            
    
    
    
    
    
    
   
}