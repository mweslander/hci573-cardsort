//JQUERY FOR UXTS Controllers

$(document).ready(function() 
{
    // CODE!!
    
    // Set empty errors and messages
    var uxtsError;
    var uxtsMessage;
    
    // Set the default for opensort columns
    var openSortColumns = 1;
    // Start the open refresh function for open cardsorts
    // to dynamically create new category placeholders
    // when the old ones fill up
    // it refreshes every 2 seconds
    startOpenRefresh();
    
    // This allows a uxts to complete the cardsort
    submitCardsort();
    
    // FUNCTIONS!!
    
    // This function submits the cardsort
    function submitCardsort()
    {
        $('#uxtsFullCardsort').submit(function(event)
        {
            var error = [];
            // Prevent the page from reloading
            event.preventDefault();
            
            // Set the emailReg for checking
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            
            // Get the parameters
            var raw_cs_id = $('#uxtsCsId').val(); // cardsort id
            // Check to see if the cs_id is okay
            if (raw_cs_id === '')
            {
                error.push("Houston we have a problem. Please try submitting again");
            }
            else // Otherwise this "should" be okay
            {
                var cs_id = raw_cs_id; // Set the cs_id
            }
            // test subject's raw email
            var raw_email = $('#uxtsEmail').val(); 
            // Check to see if the email is ok
            if (raw_email === '')
            {
                error.push("Please enter an email address");
            }
            else if (!emailReg.test(raw_email)) // Test the email against the regular expression
            {
                error.push("Please enter a valid email address");
            }
            else // Otherwise our initial checks are okay
            {
                var ts_email = raw_email; // Set the test subjects email to the raw email
            }
            
            // Check to make sure the test subject has filled in all
            // of the required demographics
            
            // Start by opening and empty array
            var dmgPairs = [];
            
            // all we need is the dmg_id and the value and filter by type
            // loop through all the inputs that have a .dmgs class
            $('.dmgs').each(function()
            {
                // Check to make sure we have a value
                // If the value is empty
                if ($(this).val() === '')
                {
                    // Pass back an error
                    error.push("Please complete all the fields");
                }
                else
                {
                    // Get the id from the input field
                    var rawDmgID = $(this).attr("id");
                    // Get rid of the prefix for the id
                    var dmgID = rawDmgID.replace('dmg', '');
                    // Get the classes from the input field
                    // Set an empty dmgType & value

                    // If the type is a date
                    if ($(this).hasClass('dmg_date'))
                    {
                        // set the type to date
                        var dmgType = "date";
                        // Get the raw value
                        var rawVal = $(this).val();
                        // Replace the slashes with dashes for mysql
                        var dmgValue = rawVal.replace(/\//g,'-');
                    }
                    // Otherwise if the type is an int
                    else if ($(this).hasClass('dmg_int'))
                    {
                        // Set the type to int
                        var dmgType = "int";
                        // Set the value to the input value
                        var dmgValue = $(this).val();
                    }
                    // Otherwise we default to string
                    else
                    {
                        // Set the type to string
                        var dmgType = "string";
                        // Set the value to the input value
                        var dmgValue = $(this).val();
                        
                    }
                    
                    // set an empty dmgObj
                    var dmgObj = {};
                    // Set the dmg id as the "key" and the value as the "value"
                    dmgObj[dmgID] = dmgValue;
                    // Pass this new object to our dmgPairs array
                    dmgPairs.push(dmgObj);
                }
            });
            //console.log(dmgPairs);
            
            // If the dmgPairs is empty, then send none
            if (dmgPairs.length <= 0)
            {
                dmgPairs = "none";
            }
            
            
            // Check to see if #unsortedCards has any li elements
            var sortComplete = $('#unsortedCards').has("li").length ? "incomplete" : "complete";
            // If there are li elements, it will come back 'incomplete'
            if (sortComplete === "incomplete")
            {
                error.push("Please sort all of the cards");
            } // Otherwise it's complete and we're good to go
            
            
            // We need to check all of the categories that have li's to 
            // see if they have a label
            
            // First set an empty array
            var cardPairs = {};
            
            $('.uxtsCatUl').each(function(){
                var categoryParentUl = $(this).has("li").length ? "yes" : "no";
                // If the parent ul has some li's in it, then we need to do 
                // some label and card processing
                if (categoryParentUl === "yes")
                {
                    // First get the category name
                    var catName = $(this).children('.uxtsCatLabel').val();
                    // If the category name is an empty string
                    if (catName === "")
                    {
                        // Push an error to the array
                        error.push("Please fill out all the category names");
                    }
                    else // Otherwise we have category names for every UL that has li's in it
                    { 
                        // Then get the ids of the cards that are in it
                        var cardIDs = $(this).children('li').children('.uxtsCard').each(function()
                        {
                            var cardID = $(this).val();
                            // Then splice them together! 
                            cardPairs[cardID] = catName;
                        });
                    }
                } // Otherwise, there are no cards in the category
            });
            
            // If there are no errors, then we can proceed
            if (error.length <= 0)
            {
                // console.log('no errors');
                // Get the JSON objects ready to go
                var dmgs = JSON.stringify(dmgPairs);
                var cards = JSON.stringify(cardPairs);
                
                var datastring = "submit=save&cs_id="+cs_id+"&ts_email="+ts_email+"&cards="+cards+"&dmgs="+dmgs;
                console.log(datastring);
                // Make the ajax call
//                $.ajax({
//                    // Post
//                    type: "POST",
//                    // to this location
//                    url: "includes/controllers/uxtsCardsortController.inc.php",
//                    data: datastring,
//                    success: function(data)
//                    {
//                        // Parse the JSON data
//                        var msg = jQuery.parseJSON(data);
//
//                        // Assign a new value to error, using the msg object
//                        csError = msg.error;
//                        csMessage = msg.message;
//                        // Check and display errors and messages
//
//                    }
//                });
                
            }
            // Otherwise log the error for now
            // and display later
            else
            {
                console.log(error);
            }
        });
        
    } // End of submit cardsort function
    
    // This refreshes the content every 2 seconds
    function startOpenRefresh() 
    {
        if ($('#uxtsCatArea').hasClass('uxtsOpenSort'))
        {
            setTimeout(startOpenRefresh,2000);
            // check to see if we need another column
            checkOpenSortColumn();
        }
    }
    
    // Check the columns in an open sort
    // for when a user exhausts the options
    function checkOpenSortColumn()
    {
        // If the open column is not empty
        // then we need to add another open column
        var tag = "#openSortable"+openSortColumns;
        var test = $(tag).has("li").length ? addOpenSortColumn() : "no";
        
    }
    
    // Add a column to an open sort
    function addOpenSortColumn()
    {
        openSortColumns++;
        var add = "<ul id='openSortable"+openSortColumns+"' class='sortable sortableCol droptrue ui-sortable uxtsCatUl'><label class='immovable'>Category Name:</label><input id='openCat" + openSortColumns + "' class='uxtsCatLabel' type='text' name='openCat" + openSortColumns + "' /></ul>";
        //Need to recall sortable and connectWith
        $(add).appendTo("#uxtsCatArea").sortable({connectWith: '.sortableCol', items: ":not(.immovable)"});
    }
    
});

// EXTRA FUNCTIONS

//   $('#uxtsAddCard').submit(function(event) {
//// Prevent the page from reloading
//        event.preventDefault();
//        // Get the variables
//        var url = window.location.search;
//        var cs_id = url.split("/");
//        if (cs_id[2]) {
//            alert(cs_id[2]);
//            var CardLabel = $('#cardLabel').val();
//            var datastring = "add=card&cs_id="+cs_id[2]+"&card_label=" + CardLabel;
//            //console.log(datastring);
//
//            $.ajax({
//// Post
//                type: "POST",
//                // To this location
//                url: "?url=uxts/addCard",
//                // The datastring defined above
//                data: datastring,
//                success: function(data)
//                {
//// Parse the JSON data
//                    //var msg = jQuery.parseJSON(data);
//                    
//                   
//                     window.location.reload(true);
//                }
//            }); // End of AJAX call
//                
//                
//        } else {
//            alert("YOU SHOULD BE HERE");
//        }
//        //Cheating
//        $(document).ajaxStop(function(){
//            window.location.reload(true);
//        });
//
//    });


//$('#uxtsAddCategory').submit(function(event) {
//// Prevent the page from reloading
//        event.preventDefault();
//        // Get the variables
//        var url = window.location.search;
//        var cs_id = url.split("/");
//        if (cs_id[2]) {
//            alert(cs_id[2]);
//            var CardLabel = $('#categoryLabel').val();
//            var datastring = "add=category&cs_id="+cs_id[2]+"&category_label=" + CardLabel;
//            //console.log(datastring);
//
//            $.ajax({
//// Post
//                type: "POST",
//                // To this location
//                url: "?url=uxts/addCategory",
//                // The datastring defined above
//                data: datastring,
//                success: function(data)
//                {
//// Parse the JSON data
//                    //var msg = jQuery.parseJSON(data);
//                    
//                   
//                     window.location.reload(true);
//                }
//            }); // End of AJAX call
//                
//                
//        } else {
//            alert("YOU SHOULD BE HERE");
//        }
//        //Cheating
//        $(document).ajaxStop(function(){
//            window.location.reload(true);
//        });
//    });