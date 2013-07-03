
<?php
/*
 * This is the homepage for usort
 *
 * @authors Mike Weslander, Ann Greazel & Brett Young
 *
 */

// ALSO, for Ann, most of this stuff will actually go elsewhere in the MVC
// but for the sake of demonstrating some new functionality, I kept it here
// for now. We will keep each other updated on where everything is going.


// CONSTANTS
// =============================================================================
// Require the path to the constants
require_once 'includes/constants/paths.inc.php';
// Require the path to the database (we may not need this if it's included in
// all of the classes that use the database)
// CONST_PATH is defined in paths.inc.php
require_once (CONST_PATH . 'sql.inc.php');



// VIEW
// =============================================================================

// Include the HTML header - Contained in Includes / Views / Templates
// LAYOUT_PATH is defined in paths.inc.php
//include (LAYOUT_PATH . 'header.inc.php');

// Include the Home and Login Views
//include (VIEW_PATH .  'home.inc.php');
//include (VIEW_PATH . 'login.inc.php');

// Include the HTML footer - Contained in Includes / Views / Templates
//include (LAYOUT_PATH . 'footer.inc.php');



/*
 * AutoLoader
 * 
 * @author Brett Young
 */

    // set null any existing autoloads 
    spl_autoload_register(null, false);

    // specify extensions to be loaded 
    spl_autoload_extensions('.php, .inc.php');

    // function loads general classes
    function classLoader($class)
    {
        $filename = strtolower($class) . '.inc.php';
        $file ='includes/classes/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
    // function load controllers
    function controllerLoader($class)
    {
        
        $filename = strtolower($class) . '.inc.php';
        $file ='includes/controllers/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
    // function loads models
    function modelLoader($class)
    {
        $filename = strtolower($class) . '.inc.php';      
        $file ='includes/models/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }

    // register the loader functions
    spl_autoload_register('classLoader');
    spl_autoload_register('controllerLoader');
    spl_autoload_register('modelLoader');
   
        
//Load bootstrap - This class with check if the systems is ready, 
//get IP Address, and the URL to direct the controllers and methods        
try 
{
    new bootstrap();
} 
catch (ErrorException $e) 
{
    return "Error: " . $e;
}

// PHP closing tag ommitted intentionally