<?php

/*
 * This page is designed to test a cardsort
 */

// This is how the classes are being called 
// Only instead of writing all of this out, Brett wrote an autoloader
// that goes through and fetches them for us
require_once 'includes/constants/paths.inc.php';
require_once (CONST_PATH . 'sql.inc.php');
require_once (CLASS_PATH . 'database.inc.php');
require_once (CLASS_PATH . 'commons.inc.php');
require_once (MODEL_PATH . 'baseModel.inc.php');
require_once (MODEL_PATH . 'CardsortModel.inc.php');
require_once (MODEL_PATH . 'CardModel.inc.php');
require_once (CTRL_PATH . 'baseController.inc.php');
require_once (CTRL_PATH . 'tsCardsortController.inc.php');

// All of this stuff belongs in the controller

$cs_id = 49;

if (isset($cs_id))
{
    $cardsort = CardsortModel::find_by_id($cs_id);
    
    if ($cardsort)
    {
        // If closed sort, loop through and get all of the categories

        // Loop through and get all of the cards
        
        // Loop through and get all of the demographics
    }
}

// And this stuff in the view
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>jQuery UI Sortable - Handle empty lists</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="resources/styles/main.css" />

<script>
$(function() {
$( "ul.droptrue" ).sortable({
connectWith: "ul"
});
$( "ul.dropfalse" ).sortable({
connectWith: "ul",
dropOnEmpty: false
});
$( "#sortable1, #sortable2, #sortable3, #sortable4, #sortable5, #sortable6" ).disableSelection();
});
</script>
</head>
<body>
<ul id="sortable1" class="droptrue">
<li class="ui-state-default">News</li>
<li class="ui-state-default">Rock solid staff</li>
<li class="ui-state-default">Step 01</li>
<li class="ui-state-default">Step 02</li>
<li class="ui-state-default">Step 03</li>
<li class="ui-state-default">Portfolio</li>
<li class="ui-state-default">Location</li>
<li class="ui-state-default">Office Hours</li>
</ul>
<ul id="sortable2" class="dropfalse">
<li class="ui-state-highlight">About Us</li>
</ul>
    
<ul id="sortable3" class="dropfalse">
<li class="ui-state-highlight">Features</li>
</ul>
    
<ul id="sortable4" class="dropfalse">
<li class="ui-state-highlight">How to Get Started</li>
</ul>

<ul id="sortable5" class="droptrue">
</ul>
<br style="clear: both;" />
</body>
</html>
