<?php

/*
 * Single point of entry
 * AutoLoad class
 * Start bootstrap
 */
require 'includes/config.inc.php';

spl_autoload_register(function($class) {

            try {

                /*
                 * find which directory the class belongs in
                 * Might be better with the php directory function 
                 */

                if (substr($class, -5) === 'model') {
                    $folder = 'models';
                } else if (substr($class, -10) === 'controller') {
                    $folder = 'controllers';
                } else {
                    $folder = $class;
                }


                switch ($folder) {
                    case 'models':
                        include 'classes/models/' . $class . '.inc.php';
                        break;
                    case 'controllers':
                        include 'classes/controllers/' . $class . '.inc.php';
                        break;
                    default :

                        include 'classes/' . $class . '.inc.php';
                }
            } catch (ErrorException $e) {
                return 'Error: ' . $e;
            }
        });

try {

    new bootstrap();
} catch (ErrorException $e) {
    return "Error: " . $e;
}











