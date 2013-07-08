<?php

/*
 * CONSTANT PATH DEFINITIONS
 * 
 * This page is used to define the commonly used paths as contants.
 * These are basically relative links that are defined so it is easy to move
 * links between pages without breaking anything.
 * 
 * @author Michael Weslander
 */

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// =============================================================================
// (\ for Windows, / for Unix}
// This makes it much easier to define the rest of the paths on the page
// First it checks to see if it's defined, and if it's null it sets the constant
// This is a ternary operator, basically what it is saying is
// If DS is defined, then define null (don't do anything) else, define DS as the
// php DIRECTORY_SEPARATOR
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// FILE STRUCTURE
// =============================================================================
// Base in operating system -- This is for the FILE STRUCTURE, not the web host
// Once this is defined, the rest of the constants dealing with FILE structure will work!
// First it checks to see if it's defined, and if it's null it sets the constant
defined ('REL_BASE') ? null : define ("REL_BASE", $_SERVER['DOCUMENT_ROOT']);
    /* If you want to see what this means on your specific setup, uncomment the
    *  following echo line and navigate to this page in your browser in order to see
    *  what is going on.
    */
//echo REL_BASE;
    /*  For me this is 'Users/Mweslander/hci573_cardsort' which points to the root
    *  directory of the uSort site which is exactly what I want. If you have your 
    *  folder nested somewhere else, for instance 'C:\apache\htdocs\usort\site' you
    *  may have to add additional parameters to this. I've added a commented example
    *  below. I use the directory separator as defined above.
    */
//defined ('REL_BASE') ? null : define ("REL_BASE", $_SERVER['DOCUMENT_ROOT'] . DS . 'hci573-cardsort');

// This makes it easier to get to the includes files
// First it checks to see if it's defined, if not it defines it
defined('INC_PATH') ? null : define('INC_PATH', REL_BASE . DS . 'includes' . DS);

// This makes it easier to get to the database constants
// First it checks to see if it's defined, it defines it
defined('CONST_PATH') ? null : define('CONST_PATH', INC_PATH . 'constants' . DS);

// This makes it easier to get to the database configuration
// First it checks to see if it's defined, it defines it
defined('CONFIG_PATH') ? null : define('CONFIG_PATH', INC_PATH . 'config' . DS);

// This makes it easier to get to the classes
// First it checks to see if it's defined, and if it's null it sets the constant
defined('CLASS_PATH') ? null : define('CLASS_PATH', INC_PATH . 'classes' . DS);

// This makes it easier to get to the controllers
// First it checks to see if it's defined, it defines it
defined('CTRL_PATH') ? null : define('CTRL_PATH', INC_PATH . 'controllers' . DS);

// This makes it easier to get to the models
// First it checks to see if it's defined, it defines it
defined('MODEL_PATH') ? null : define('MODEL_PATH', INC_PATH . 'models' . DS);

// This makes it easier to get to the views
// First it checks to see if it's defined, it defines it
defined('VIEW_PATH') ? null : define('VIEW_PATH', INC_PATH . 'views' . DS);

// This makes it easier to get to the view layout templates - ie header & footer
// First it checks to see if it's defined, it defines it
defined('LAYOUT_PATH') ? null : define('LAYOUT_PATH', VIEW_PATH . 'templates' . DS);

// This makes it easier to get to the admin views
// First it checks to see if it's defined, it defines it
defined('ADVIEW_PATH') ? null : define('ADVIEW_PATH', VIEW_PATH . 'admin' . DS);

// This makes it easier to get to the uxr views
// First it checks to see if it's defined, it defines it
defined('UXR_PATH') ? null : define('UXR_PATH', VIEW_PATH . 'uxr' . DS);

// URL PATHS
// =============================================================================
// These are for the client side paths. Mostly for the resources folder

// Base in the URL STRUCTURE, not the file system. Ex. http://usort.us
// Once this is defined, the rest of the constants dealing with URL structure will work!
// First it checks to see if it's defined, and if it's null it sets the constant
defined ('BASE') ? null : define ("BASE", "http://" . $_SERVER['HTTP_HOST']);
   /*  If you want to see what this means on your specific setup, uncomment the
    *  following echo line and navigate to this page in your browser in order to see
    *  what is going on.
    */
// echo BASE;
   /*  For me this is 'http://usort.dev' which points to the root
    *  url of the uSort site which is exactly what I want. If you have your 
    *  folder nested somewhere else, for instance 'C:\apache\htdocs\usort\site' you
    *  may have to add additional parameters to this. I've added a commented example
    *  below. I use the directory separator as defined above.
    */
//defined ('BASE') ? null : define ("BASE", "http://" . $_SERVER['HTTP_HOST'] . DS . 'hci573-cardsort');

// This makes it easier to get to the client-side resource files
// First it checks to see if it's defined, and if it's null it sets the constant
defined('RESOURCE_PATH') ? null : define('RESOURCE_PATH', BASE . '/resources/');

// This makes it easier to get to the css files
// First it checks to see if it's defined, and if it's null it sets the constant
defined('STYLE_PATH') ? null : define('STYLE_PATH', RESOURCE_PATH . 'styles/');

// This makes it easier to get to the javascript files
// First it checks to see if it's defined, and if it's null it sets the constant
defined('JS_PATH') ? null : define('JS_PATH', RESOURCE_PATH . 'scripts/');

// This makes it easier to get to the images
// First it checks to see if it's defined, and if it's null it sets the constant
defined('IMG_PATH') ? null : define('IMG_PATH', RESOURCE_PATH .'images/' );


// SELF
// =============================================================================
define ("SELF", $_SERVER['PHP_SELF']);
