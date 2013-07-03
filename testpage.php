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


$user = new UserModel();
var_dump($user);