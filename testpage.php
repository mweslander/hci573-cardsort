<html>
<head>
    <title>test page</title>
    <link rel="stylesheet" type="text/css" href="resources/styles/main.css" />   
</head>
<body>
    <div id="homecontent">
        <p>This is where we can add the intro paragraphs and a link to the demo.</p>
    </div>
<?php
    include 'includes/views/login.inc.php';
?>
</body>
</html>




<?php

// This is how the classes are being called 
// Only instead of writing all of this out, Brett wrote an autoloader
// that goes through and fetches them for us
require_once 'includes/constants/paths.inc.php';
require_once 'includes/constants/sql.inc.php';
require_once "includes/classes/database.inc.php";
require_once 'includes/models/baseModel.inc.php';
require_once 'includes/models/cardModel.inc.php';
require_once 'includes/models/cardSortModel.inc.php';
require_once 'includes/models/categoryModel.inc.php';
require_once 'includes/models/demographicModel.inc.php';
require_once 'includes/models/testCardModel.inc.php';
require_once 'includes/models/testDmgModel.inc.php';
require_once 'includes/models/testDmgDateModel.inc.php';
require_once 'includes/models/testDmgIntModel.inc.php';
require_once 'includes/models/testDmgStringModel.inc.php';
require_once 'includes/models/testModel.inc.php';
require_once 'includes/models/testSubjectModel.inc.php';
require_once 'includes/models/userModel.inc.php';

// Whenever we want to interact with a user, we need to instantiate a user object
// This is how you do that:
$user = new UserModel();
// Notice how (in the browser) there is nothing in this object.
var_dump($user); // This is a very useful variable dump function that shows you what is in your variable


// This is how you assign values to the object
$user->user_name = "mweslander";
$user->user_password = "test";
$user->user_role = "uxr";
$user->user_email = "mrw@iastate.edu";
$user->first_name = "Michael";
$user->last_name = "Weslander";
$user->activation_code = rand(1000,9999);
$user->num_logins = 1;
$user->last_login = date(DATE_ATOM);
// This time when we "dump" the variable, notice how the same user object we instantiated
// before now has properties! Once these properties are added to the user object
// we can use them.
var_dump($user);

// Now we can test the registration SQL for the user
// This is how you call a method (function) from within a class
//$user->register();

