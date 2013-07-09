<?php

/*
 * Header
 */
 
?>       
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title ?></title>
        
        <!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_PATH . "main.css"; ?>"/>
        
        <!-- JavaScript -->
        <script src="<?php echo JS_PATH . "jquery-1.9.1.min.js"; ?>"></script>
        
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        
        <script src="<?php echo JS_PATH . "register.js"; ?>"></script>
        <script src="<?php echo JS_PATH . "uxrSort.js"; ?>"></script>
        <script src="<?php echo JS_PATH . "uxtsSort.js"; ?>"></script>
    </head>
    <body>
        <div id="wrapper"><!-- Wrapper div closed in footer.inc.php -->
            <header>
                <div id="top-bar">
                 <div id="logo">
                     <a href="<?php echo BASE ;?>"><img src="<?php echo IMG_PATH ;?>usort_logo.png" /></a>
                 </div>
                </div>
                
                 <?php  include  VIEW_PATH . '/templates/menu.inc.php'; // includes menu ?>
            </header>
       
        
<?php
// Closing tags ommitted intentionally