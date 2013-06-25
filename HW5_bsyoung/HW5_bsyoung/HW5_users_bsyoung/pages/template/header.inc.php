<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel='stylesheet' href='<?php echo BasePath; ?>includes/style/style.css' />
        <script src='<?php echo BasePath; ?>includes/js/jquery-1.9.1.min.js'></script>
        <script src='<?php echo BasePath; ?>includes/js/my_jquery.js'></script>

    </head>
    <body>
        <div id="header" >
            <div id="logoBox">
                <a href="<?php echo BasePath; ?>home">
                    <img id='logo' class="logo" src='<?php echo BasePath?>includes/images/by_logo.png'/>
                </a>
            </div>
            <nav>
                <?php include 'pages/template/menu.inc.php'; ?>
                
            </nav>
            <div class='clearfix'></div>
            <div class='headerbar' ><span>You are here: <?php echo $title; ?></span> </div>
    </div> 
