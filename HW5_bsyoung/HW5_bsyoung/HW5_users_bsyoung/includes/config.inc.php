<?php

/*
 * Config file
 * 
 */

/*
 * ini Set Error Display
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

/*
 * DB Contants
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'hci573');
define('DB_USER', 'hci573');
define('DB_PASS', 'hci573');
//tables needed
define('DB_TB1', 'HCI_bsyoung');
define('DB_TB2', 'USERS_bsyoung');


/*
 * Base Paths
 */

define('BasePath',"Http://".$_SERVER['HTTP_HOST'] ."/HCI573/HW5_bsyoung/HW5_users_bsyoung/");




?>
