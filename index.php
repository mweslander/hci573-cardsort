
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
// CONST_PATH and DS(DIRECTORY_SEPARATOR) are defined in paths.inc.php
require_once (CONST_PATH . DS . 'sql.inc.php');



// VIEW
// =============================================================================

// Include the HTML header - Contained in Includes / Views / Templates
// LAYOUT_PATH and DS(DIRECTORY_SEPARATOR) are defined in paths.inc.php
include (LAYOUT_PATH . DS . 'header.inc.php');

// Include the Home and Login Views
include (VIEW_PATH . DS . 'home.inc.php');
include (VIEW_PATH . DS . 'login.inc.php');

// Include the HTML footer - Contained in Includes / Views / Templates
include (LAYOUT_PATH . DS . 'footer.inc.php');

// PHP closing tag ommitted intentionally