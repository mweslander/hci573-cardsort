<?php

/*
 * Bootstrap
 * 
 * @author Brett Young
 * @comments: single point of entry to the site
 */

class bootstrap {

    protected $db;
    protected $controller;

    /*
     * Constructor
     */

    public function __construct() {
        //echo "in bootstrap<br/>";

        $this->db = Database::init();

        //createTables if they don't exist
        $this->_createTables(DB_TB1);
        $this->_createTables(DB_TB2);

        //find url path
        $this->_getController();
    }

    /*
     * Check if db and tables exist.
     */

    private function _createTables($tbname) {

        switch ($tbname) {
            case DB_TB1:
                //DB_TB1 - is HCI_bsyoung
                $stmtTB = $this->db->prepare("CREATE TABLE IF NOT EXISTS $tbname(
                                               uid bigint(20) NOT NULL AUTO_INCREMENT,
                                               user_name varchar(200) NOT NULL DEFAULT '',
                                               user_email longblob,
                                               user_pass varchar(200) NOT NULL DEFAULT '',
                                               activation_code varchar(30) NOT NULL,
                                               member_date date NOT NULL DEFAULT '0000-00-00',
                                               PRIMARY KEY (`uid`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
                $stmtTB->execute();              
                //echo "Table has been created";  
                break;

            case DB_TB2:
                //DB_TB2 - is USERS_bsyoung
                $stmtTB = $this->db->prepare("CREATE TABLE IF NOT EXISTS $tbname(
                                               id bigint(20) NOT NULL,
                                               uid varchar(200) NOT NULL DEFAULT '',
                                               last_login timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
                                               ip varchar(15) NOT NULL DEFAULT '',
                                               PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
                $stmtTB->execute();
                //echo "Table has been created";  
                break;
        }
    }

    private function _getController() {

        //Explode url by / or call home controller
        if (!empty($_GET['url'])) {
            //print_r($_GET);
            $param = rtrim($_GET['url'], "/");
            $params = explode("/", $param);
        } else {
            $params[0] = 'Home';
        }
        //Set Controller from params[0] or set default controller ie Homecontroller
        if (isset($params[0]) && !empty($params[0])) {

            //check if controller exists
            if (!file_exists('classes/controllers/' . strtolower($params[0]) . 'Controller.inc.php')) {
                //construct error controller
                echo "<br >Controller doesn't exist<br />";
                $controllerError = new Error();
                return FALSE;
            }

            //Start Controller
            $controllerName = ucwords(strtolower($params[0])) . 'controller'; //ie Homecontroller
            $this->controller = new $controllerName();
            
            $modelName = ucwords(strtolower($params[0])) . 'model'; //ie Homemodel            
            $this->controller->_setModel($modelName);
            
            //if args exist set arguments in Method in Controller ie Controller method(arg)
            if (isset($params[2]) && !empty($params[2])) {                
                //check if method is in the controllers class
                if (!method_exists($this->controller, $params[1])) {
                    // call error controller 
                    echo "<br />Method doesnt exist. Check in Param[2]<br />";
                    $controllerError = new Error();
                    return FALSE;
                }
                //sets controllers method and args
                $this->controller->{$params[1]}($params[2]);
                $this->controller->_setModel($modelName);
                
            } else if(isset($params[1]) && !empty($params[1])) {
                //No args then check if Method is in url
               
                    //check if method is inside the class
                    if (!method_exists($this->controller, $params[1])) {
                        // call error controller                        
                        echo "<br />Method doesnt exist. Check in Param[1]<br />";
                        $controllerError = new Error();                       
                        return FALSE;
                    }
                //set controllers method    
                $this->controller->{$params[1]}();       
                $this->controller->_setModel($modelName);
            }else{
                //sets the default method to call if no method
                $this->controller->index();
                $this->controller->_setModel($modelName);
            }

        } else {
            //if not params are set then go to homecontroller
            $controllerName = 'Homecontroller'; //ie Homecontroller
            $this->controller = new $controllerName();
            $this->controller->index();
            $this->controller->_setModel($modelName);
        }
    }
}
// ending php tag omitted
