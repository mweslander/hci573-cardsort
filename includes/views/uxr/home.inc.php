<?php

/*
 * UXR Home
 */


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
    <form id="uxrCardsortControl">
        <!-- Name of Cardsort -->
        <h3><label for="cardsortName">Cardsort Name</label></h3>
        <input id="cardsortName" type="text" />
        <!-- Type of Cardsort (open / closed) -->
        <h3>Cardsort Type</h3>
        <input id="openCardsort" type="radio" name="cardsortType" value="open" /><label for="openCardsort">Open</label>
        <input id="closedCardsort" type="radio" name="cardsortType" value="closed" /><label for="closedCardsort">Closed</label>
        <!-- Cardsort categories (if closed is chosen above) -->
        <h3>Categories</h3>
        <!-- This is where the dynamically created inputs will go -->
        <!-- This form submits to an AJAX page which adds the category -->
        <form id="uxrCardsortCategories">
            <input id="cardsortCategoryLabel" type="text" />
            <input id ="addCardsortCategory" type="submit" value="Add" />
        </form>
        <!-- Demographics needed -->
        <h3>Demographics</h3>
        <!-- This is where the dynamically created inputs will go -->
        <!-- This form submits to an AJAX page which adds the demographic -->
        <form id="uxrCardsortDemographics">
            <label for="cardsortDemographicsLabel">Label</label> 
            <input id="cardsortDemographicsLabel" type="text" />
            <label for="cardsortDemographicsType">Type</label> 
            <select id="cardsortDemographicsType"> <!-- This might be better as radio buttons -->
                <option value="string">Text</option>
                <option value="int">Number</option>
                <option value="date">Date</option>
            </select> 
            <input id ="addCardsortDemographic" type="submit" value="Add" />
        </form>
        <!-- Password protected? -->
        <input id ="createCardsort" type="submit" value="Create Cardsort" />
    </form>  
</section>


<?php
// THIRD
// We need our main content area that functions in conjunction with the sidebar
?>
<section id="uxrView">
    <h2>Cardsort View</h2>
</section>

<div class="clear"></div>
<?php


// FOURTH
// We need a footer. This is already included from the views/templates/footer.inc.php