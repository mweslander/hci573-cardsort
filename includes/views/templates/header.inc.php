<?php

/*
 * Header
 */
 
?>       
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title ?></title>
        
        <!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_PATH . "main.css"; ?>"/>
        
        <!-- JavaScript -->
        <script src="<?php echo JS_PATH . "jquery-1.9.1.min.js"; ?>"></script>
        <script src="<?php echo JS_PATH . "register.js"; ?>"></script>
    </head>
    <body>
        <div id="wrapper"><!-- Wrapper div closed in footer.inc.php -->
            <header>
                 <div id="logo">
                     <a href="<?php echo BASE ;?>"><img src="<?php echo IMG_PATH ;?>usort_logo.png" /></a>
                 </div>
                
                 <?php  include  VIEW_PATH . '/templates/menu.inc.php'; // includes menu ?>
            </header>
       
        
<?php
// Closing tags ommitted intentionally