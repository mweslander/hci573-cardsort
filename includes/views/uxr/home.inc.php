<?php

/*
 * UXR Home
 */

echo "Variables needed from session: user_id<br>";
$user_id = 6;
echo "test user_id = " . $user_id;

var_dump($_SESSION);


// echo "IN UXR PAGE";

// FIRST
// We need a header. This is included already from the views/templates/header.inc.php
// using the uxrController.inc.php and the page template


// SECOND
// We need a sidebar on the left side that functions as our control bar
// Ihis is probably going to be located in the sidebar template, but for now, I'm building
// it up here, in order to make sure that everything works properly for the demo
// Brett, I'll let you split it up however you would like.
?>
<section id="uxrControl">
    <h2>Control Box</h2>
    
    <!-- Name and type of Cardsort -->
    <form id="uxrCardsortDetails">  
        <!-- Name of Cardsort -->
        <h3>Cardsort Details</h3>
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" />
        <label for="cardsortName">Cardsort Name</label>
        <input id="cardsortName" name="cardsortName" type="text" />
        <br>
        <!-- Type of Cardsort (open / closed) -->
        <label>Cardsort Type</label>
        <input id="openCardsort" type="radio" name="cardsortType" value="open" checked /><label for="openCardsort">Open</label>
        <input id="closedCardsort" type="radio" name="cardsortType" value="closed" /><label for="closedCardsort">Closed</label>
        <br>
        <p>If you would like your Cardsort to be password protected, enter it here. Note: this is a very low level of security, you will send the same password to all your participants in a given cardsort.</p>
        <label for="uxrCardsortPassword">Password?</label>
        <input id="yesPassword" type="radio" name="passwordToggle" value="yes" /><label for="yesPassword">Yes</label>
        <input id="noPassword" type="radio" name="passwordToggle" value="no" checked /><label for="noPassword">No</label>
        <input id="uxrCardsortPassword" name="uxrCardSortPassword" type="text" />
        <br>
        <!-- Add Cardsort -->
        <input id ="addCardsortName" type="submit" value="Create / Update" />  
    </form>
    <hr>
    
    <!-- Cardsort categories (if closed is chosen above) -->   
    <!-- This form submits to an AJAX page which adds the category -->
    <form id="uxrCardsortCategories">
        <h3>Categories</h3>
        <input id="cardsortCategoryLabel" type="text" />
        <input id ="addCardsortCategory" type="submit" value="Add" />
    </form>
    <hr>
    
    <!-- Cardsort cards -->   
    <!-- This form submits to an AJAX page which adds the card -->
    <form id="uxrCardsortCards">
        <h3>Cards</h3>
        <input id="cardsortCardLabel" type="text" />
        <input id ="addCardsortCard" type="submit" value="Add" />
    </form>
    <hr>
    
    <!-- Demographics needed -->    
    <!-- This form submits to an AJAX page which adds the demographic -->
    <form id="uxrCardsortDemographics">
        <h3>Demographics</h3>
        <label for="cardsortDemographicsLabel">Label:</label> 
        <input id="cardsortDemographicsLabel" type="text" />
        <br>
        <label for="cardsortDemographicsType">Type:</label> 
        <!-- Radio buttons for type of data -->
        <input id="demographicsString" type="radio" name="demographicsType" value="string" checked /><label for="demographicsString">Text</label>
        <input id="demographicsInt" type="radio" name="demographicsType" value="int" /><label for="demographicsInt">Number</label>
        <input id="demographicsDate" type="radio" name="demographicsType" value="date" /><label for="demographicsDate">Date</label>
        <br>
        <input id ="addCardsortDemographic" type="submit" value="Add" />
    </form>
</section>


<?php
// THIRD
// We need our main content area that functions in conjunction with the sidebar
?>
<section id="uxrView">
    <form id="cardsortFullDetail">
        <!-- These details will be updated when the UXR adds a cardsort -->
        <div id="uxrViewDetails">
            <h2>Cardsort Name: <span></span></h2> <!-- Defined in uxrSort.js -->
            <p>Cardsort Type: <span></span></p><!-- Defined in uxrSort.js -->
        </div>
        <hr>
        <!-- Categories -->
        <div id="uxrViewCategories">
            <h2>Categories</h2>
            <div>
                <span>None</span>
            </div>
        </div>
        <hr>
        <!-- Cards -->
        <div id="uxrViewCards">
            <h2>Cards</h2>
            <div>
                <span>None</span>
            </div>
        </div>
        <hr>
        <!-- Demographics -->
        <div id="uxrViewDemographics">
            <h2>Demographics</h2>
            <div>
                <span>Label</span>
                <span>Type</span>
            </div>
        </div>
        <hr>
        <!-- Password -->
        <div id="uxrViewPassword">
            <h2>Password</h2>
            <div>
                <span>None</span>
            </div>
        </div>
        <hr>
        <!-- Create URL -->
        <input id="createURL" type="submit" value="Create URL" />
        
    </form>
</section>

<div class="clear"></div>
<?php


// FOURTH
// We need a footer. This is already included from the views/templates/footer.inc.php