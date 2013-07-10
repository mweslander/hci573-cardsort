<?php

/*
 * UXR Home
 */

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
    <button id="csEdit">Dashboard</button><button id="csList">Studies</button>
    <!-- !!!!!!!!!!!! EDIT SECTION !!!!!!!!!!!! -->
    <div id="cardsortEdit">
        <!-- Name and type of Cardsort -->
        <form id="uxrCardsortDetails">  
            <!-- Name of Cardsort -->
            <h2>Cardsort Details</h2>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" />
            <label for="cardsortName"><p>Cardsort Name</label>
            <input id="cardsortName" name="cardsortName" type="text" /></p>
            <br>
            <!-- Type of Cardsort (open / closed) -->
            <label><p>Cardsort Type</label>
            <input id="openCardsort" type="radio" name="cardsortType" value="open" checked /><label for="openCardsort">Open</label>
            <input id="closedCardsort" type="radio" name="cardsortType" value="closed" /><label for="closedCardsort">Closed</label></p>
            <br>
            <p>If you would like your Cardsort to be password protected, enter it here. Note: this is a very low level of security, you will send the same password to all your participants in a given cardsort.</p>
            <label for="uxrCardsortPassword"><p>Password?</label>
            <input id="yesPassword" type="radio" name="passwordToggle" value="yes" /><label for="yesPassword">Yes</label>
            <input id="noPassword" type="radio" name="passwordToggle" value="no" checked /><label for="noPassword">No</label>
            <input id="uxrCardsortPassword" name="uxrCardSortPassword" type="text" value="Type Password if applicable" /></p>
            <br>
            <!-- Add Cardsort -->
            <input id ="addCardsortName" type="submit" value="Create / Update" /> 
            <hr>
        </form>

        <!-- Cardsort categories (if closed is chosen above) -->   
        <!-- This form submits to an AJAX page which adds the category -->
        <form id="uxrCardsortCategories">
            <h3>Categories</h3>
            <input id="cardsortCategoryLabel" type="text" />
            <input id ="addCardsortCategory" type="submit" value="Add" />
            <hr>
        </form>

        <!-- Cardsort cards -->   
        <!-- This form submits to an AJAX page which adds the card -->
        <form id="uxrCardsortCards">
            <h3>Cards</h3>
            <input id="cardsortCardLabel" type="text" />
            <input id ="addCardsortCard" type="submit" value="Add" />
            <hr>
        </form>

        <!-- Demographics needed -->    
        <!-- This form submits to an AJAX page which adds the demographic -->
        <form id="uxrCardsortDemographics">
            <h3>Demographics</h3>
            <label for="cardsortDemographicsLabel"><p>Label:</label> 
            <input id="cardsortDemographicsLabel" type="text" /></p>
            <br>
            <label for="cardsortDemographicsType"><p>Type:</label> 
            <!-- Radio buttons for type of data -->
            <input id="demographicsString" type="radio" name="demographicsType" value="string" checked /><label for="demographicsString">Text</label>
            <input id="demographicsInt" type="radio" name="demographicsType" value="int" /><label for="demographicsInt">Number</label>
            <input id="demographicsDate" type="radio" name="demographicsType" value="date" /><label for="demographicsDate">Date</label></p>
            <br>
            <input id ="addCardsortDemographic" type="submit" value="Add" />
        </form>
    </div> <!-- End of Cardsort Edit Div -->
    <!-- !!!!!!!!!!!! END OF EDIT SECTION !!!!!!!!!!!! -->
    <!-- !!!!!!!!!!!! STUDIES SECTION !!!!!!!!!!!! -->
    <div id="myStudiesList">
        <section class="ActiveStudies">
            <h3>Your Studies</h3>
            <div id='studyList'>
                <?php  
                    // DUMP THE TEST SUBJECTS STUDIES HERE
                    //var_dump($study);
                    if(isset($study))
                    {
                ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Study</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                                foreach ($study as $key => $value) 
                                {

                                    // echo "<li><a href='?url=uxts/index/$key'>". $value . "</a></li>";
                                    echo "<tr id={$key}><td class='csListView'>{$value}</td><td class='csListEdit'>E</td><td class='csListDelete'>X</td></tr>";
                                }
                        ?>
                    </tbody>
                </table>
                <?php
                    }
                    else
                    {
                        // echo "<li><a href='?url=uxr'>Start a study</a></li>"; 
                        echo "<button id='startCsStudy'>Start a study</button>";
                    }
                ?>
            </div>     
        </section>
    </div> <!-- End of myStudiesList Div -->
    <!-- !!!!!!!!!!!! END STUDIES SECTION !!!!!!!!!!!! -->
</section>


<?php
// THIRD
// We need our main content area that functions in conjunction with the sidebar
?>
<section id="uxrView">
    <!-- !!!!!!!!!!!! EDIT VIEW SECTION !!!!!!!!!!!! -->
    <div id="cardsortViewDetails">
        <!-- These details will be updated when the UXR adds a cardsort -->
        <div id="uxrViewDetails">
            <h2>Cardsort Name: <span></span></h2> <!-- Defined in uxrSort.js -->
            <p>Cardsort Type: <span></span></p><!-- Defined in uxrSort.js -->
        </div>
        <hr>
        <!-- Categories -->
        <div id="uxrViewCategories">
            <h2>Categories</h2>
            <div id="catAdditions">
                <span id="noCat">None</span><!-- Defined in uxrSort.js -->
            </div>
            <hr>
        </div>
        
        <!-- Cards -->
        <div id="uxrViewCards">
            <h2>Cards</h2>
            <div id="cardAdditions">
                <span id="noCards">None</span><!-- Defined in uxrSort.js -->
            </div>
            <hr>
        </div>
        
        <!-- Demographics -->
        <div id="uxrViewDemographics">
            <h2>Demographics</h2>
            <table>
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Type</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="dmgAdditions">
                    <tr class="noDmgs">
                        <td>Ex: Occupation</td>
                        <td>Text</td>
                        <td>Delete</td>
                    </tr>
                    <tr class="noDmgs">
                        <td>Ex: Approximate Income</td>
                        <td>Number</td>
                        <td>Delete</td>
                    </tr>
                    <tr class="noDmgs">
                        <td>Ex: Birthday</td>
                        <td>Date</td>
                        <td>Delete</td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>   
        <!-- Password -->
        <div id="uxrViewPassword">
            <h2>Password</h2>
            <p><span></span></p><!-- Defined in uxrSort.js -->
            <hr>
        </div>
        <!-- Create URL -->
        <button id="createURL">Create URL</button>
    </div>
    <!-- !!!!!!!!!!!! END EDIT VIEW SECTION !!!!!!!!!!!! -->
    <!-- !!!!!!!!!!!! STUDIES VIEW SECTION !!!!!!!!!!!! -->
    <div id="cardsortViewStudy">
    </div>
    <!-- !!!!!!!!!!!! END STUDIES VIEW SECTION !!!!!!!!!!!! -->
</section>

<div class="clear"></div>
<?php


// FOURTH
// We need a footer. This is already included from the views/templates/footer.inc.php