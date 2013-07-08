/* 
 * This file contains the javascript for the UXR section of the card sort
 */

$(document).ready(function(){
   
    // CODE!!!
    
    // Set an empty cardsort id
    var cs_id = 0;
    
    // Set empty errors & messages
    var csError;
    var csMessage;
    var catCount = 0;
    var cardCount = 0;
    var dmgsCount = 0;
    
    addCardsort();
    addCategory();
    addCard();
    addDemographic();
    
    showCardsortType('open');
    showCardsortName(0);
    showCardsortPassword(null);
    showCardAdd(cs_id);
    showDemographicsAdd(cs_id);
    
    // These set defaults of none to the view
    showAddedCategories(catCount);
    showAddedCards(cardCount);
    showAddedDemographics(dmgsCount);
    
    // These are the deletion functions
    deleteDmg();
    
    
    // FUNCTIONS!!!
    
    // Add a new cardsort function
    function addCardsort()
    {
        $('#uxrCardsortDetails').submit(function(event)
        {
            // Prevent the page from reloading
            event.preventDefault();
            
            // Get the user_id, cardsort name and type from the form
            var user_id = $('#user_id').val();
            var cardsort_name = $('#cardsortName').val();
            var cardsort_type = $('input[name=cardsortType]:checked', '#uxrCardsortDetails').val();
            // Assign the variable to check if the UXR wants a password or not
            var passwordToggle = $('input[name=passwordToggle]:checked', '#uxrCardsortDetails').val();
            
            // If the UXR decides to add a password, then include it in the string
            if (passwordToggle === "yes")
            {
                var cardsort_password = $('#uxrCardsortPassword').val();
                var datastring = "add=cardsort"+"&user_id="+user_id+"&cardsort_name="+cardsort_name+"&cardsort_type="+cardsort_type+"&password="+cardsort_password;
            }
            // Otherwise don't
            else
            {
                var datastring = "add=cardsort"+"&user_id="+user_id+"&cardsort_name="+cardsort_name+"&cardsort_type="+cardsort_type;
            } 
            
            // If the Cardsort ID is already set, then add it to the datastring
            if (cs_id !== 0)
            {
                datastring += "&cs_id="+cs_id;
            }
            
            $.ajax({
                // Post
                type: "POST",
                // to this location
                url: "includes/controllers/uxrCardsortController.inc.php",
                data: datastring,
                success: function(data)
                {
                    // Parse the JSON data
                    var msg = jQuery.parseJSON(data);

                    // Assign a new value to error, using the msg object
                    csError = msg.error;
                    csMessage = msg.message;
                    // Check and display errors and messages
                    
                    if (!(jQuery.isEmptyObject(csMessage)))
                    {
                        cs_id = csMessage.cs_id;
                        showCardsortName(csMessage.cs_name);
                        showCardsortType(csMessage.cs_type);
                        showCardsortPassword(csMessage.cs_password);
                        showCardAdd(cs_id);
                        showDemographicsAdd(cs_id);
                    }

                }
            });
            
        });
    }
    
    // Add a new card function
    function addCard()
    {
        $('#uxrCardsortCards').submit(function(event)
        {
            // Prevent the page from reloading
            event.preventDefault();
            
            // Get the variables
            var cardsortCardLabel = $('#cardsortCardLabel').val();
            var datastring = "add=card"+"&cs_id="+cs_id+"&card_label="+cardsortCardLabel;
            
            // console.log(datastring);
            
            $.ajax({
                // Post
                type: "POST",
                // To this location
                url: "includes/controllers/uxrCardController.inc.php",
                // The datastring defined above
                data: datastring,
                success: function(data)
                {
                    // Parse the JSON data
                    var msg = jQuery.parseJSON(data);

                    // Assign a new value to error, using the msg object
                    csError = msg.error;
                    csMessage = msg.message;
                    // Check and display errors and messages
                    
                    // If the csMessage object isn't empty then do this
                    if (!(jQuery.isEmptyObject(csMessage)))
                    {
                        // append a new card div to the view!!
                        cardCount++;
                        showAddedCards(cardCount, csMessage.card_label);
                    }

                }
            }); // End of AJAX call
            
        });
    }
    
    // Add a new category function
    function addCategory()
    {
        $('#uxrCardsortCategories').submit(function(event)
        {
            // Prevent the page from reloading
            event.preventDefault();
            // Get the variables
            var cardsortCategoryLabel = $('#cardsortCategoryLabel').val();
            var datastring = "add=category"+"&cs_id="+cs_id+"&category_label="+cardsortCategoryLabel;
            
            $.ajax({
                // Post
                type: "POST",
                // To this location
                url: "includes/controllers/uxrCategoryController.inc.php",
                // The datastring defined above
                data: datastring,
                success: function(data)
                {
                    // Parse the JSON data
                    var msg = jQuery.parseJSON(data);

                    // Assign a new value to error, using the msg object
                    csError = msg.error;
                    csMessage = msg.message;
                    // Check and display errors and messages
                    
                    // If the csMessage object isn't empty, then do this
                    if (!(jQuery.isEmptyObject(csMessage)))
                    {
                        // append a new category div to the view!!
                        catCount++;
                        showAddedCategories(catCount, csMessage.category_label);
                    }

                }
            }); // End of AJAX call
        });
    } // end of addCategory function
    
    
    // Add a new demographic function
    function addDemographic()
    {
        $('#uxrCardsortDemographics').submit(function(event)
        {
            // Prevent the page from reloading
            event.preventDefault();
            // Get the variables
            var cardsortDmgsLabel = $('#cardsortDemographicsLabel').val();
            var cardsortDmgsType = $('input[name=demographicsType]:checked', '#uxrCardsortDemographics').val();
            var datastring = "add=demographic"+"&cs_id="+cs_id+"&dmgs_label="+cardsortDmgsLabel+"&dmgs_type="+cardsortDmgsType;
                    
            console.log(datastring);
            
            
            $.ajax({
                // Post
                type: "POST",
                // To this location
                url: "includes/controllers/uxrDmgsController.inc.php",
                // The datastring defined above
                data: datastring,
                success: function(data)
                {
                    // Parse the JSON data
                    var msg = jQuery.parseJSON(data);

                    // Assign a new value to error, using the msg object
                    csError = msg.error;
                    csMessage = msg.message;
                    // Check and display errors and messages
                    
                    // If the csMessage object isn't empty, then do this
                    if (!(jQuery.isEmptyObject(csMessage)))
                    {
                        // append a new category div to the view!!
                        dmgsCount++;
                        
                        var type;
                        // Switch the cases from the database
                        // to make the output more understandable
                        // for the uxr
                        switch(csMessage.dmg_type)
                        {
                            case 'int':
                                type = "Number";
                                break;
                            case 'date':
                                type = "Date";
                                break;
                            // String is the default case
                            default:
                                type = "Text";    
                        } // End of switch statement
                        
                        showAddedDemographics(dmgsCount, csMessage.dmg_id, csMessage.dmg_label, type);
                    }
                } // End of success processing
            }); // End of AJAX call
        }); // End of submit function
    } // End of addDemographic function
    
    // Name of the cardsort display function
    function showCardsortName(name)
    {
        if (name !== 0)
        {
            $('h2 > span','#uxrViewDetails').html(name);
        }
        else
        {
            $('h2 > span','#uxrViewDetails').html("Untitled");
        }
    }
    
    // Type of cardsort display function
    function showCardsortType(cs_type)
    {
        if (cs_type === 'closed')
        {
            $('p > span','#uxrViewDetails').html("Closed Sort");
            $('#uxrViewCategories').show();
            $('#uxrCardsortCategories').show();
        }
        else
        {
            $('p > span','#uxrViewDetails').html("Open Sort");
            $('#uxrViewCategories').hide();
            $('#uxrCardsortCategories').hide();
        }
    }
    
    // Password display function
    function showCardsortPassword(cs_password)
    {
        if (cs_password === null)
        {
            $('#uxrViewPassword').hide();
        }
        else
        {
            $('#uxrViewPassword').show();
            $('p > span','#uxrViewPassword').html(cs_password);
        }
    }
    
    // Add card display function
    function showCardAdd(cs_id)
    {
        if (cs_id === 0)
        {
            $('#uxrCardsortCards').hide();
            $('#uxrViewCards').hide();
        }
        else
        {
            $('#uxrCardsortCards').show();
            $('#uxrViewCards').show();
        }
    }
    
    // Add demographics display function
    function showDemographicsAdd(cs_id)
    {
        if (cs_id === 0)
        {
            $('#uxrCardsortDemographics').hide();
            $('#uxrViewDemographics').hide();
        }
        else
        {
            $('#uxrCardsortDemographics').show();
            $('#uxrViewDemographics').show();
        }
    }
    
    // Add category display function
    function showAddedCategories(catCount, category)
    {
        if (catCount === 0)
        {
            $('#noCat').show().html("None");
        }
        else
        {
            $('#noCat').hide();
            $('<span>'+category+'</span><br>').appendTo('#catAdditions');
        }
    }
    
    // Add card display function
    function showAddedCards(cardCount, card_label)
    {
        if (cardCount === 0)
        {
            $('#noCards').show().html("None");
        }
        else
        {
            $('#noCards').hide();
            $('<span>'+card_label+'</span><br>').appendTo('#cardAdditions');
        }
    }
    
    // Add Demographics display function
    function showAddedDemographics(dmgsCount, dmg_id, dmg_label, dmg_type)
    {
        if (dmgsCount === 0)
        {
            $('.noDmgs').show();
        }
        else
        {
            $('.noDmgs').hide();
            $('<tr id='+dmg_id+'><td>'+dmg_label+'</td><td>'+dmg_type+'</td><td class="dmg_delete">X</td></tr>').appendTo('#dmgAdditions');
        }
    }
    
    // This is for when you click the delete button in the dmgs table
    function deleteDmg()
    {
        $('#dmgAdditions').on('click','td.dmg_delete', function()
        {
            var currentRow = $(this);
            // We set a new variable to the rows id
            var useThisID = $(this).parent().attr('id');
            // Then we use the deleteTime function to remove the time with this id from the database
            deleteDatabaseDmg(useThisID, currentRow);

            // Need to find a way to show the deletion
            
        });
    }
    
    
    // Delete a single dmg row from the database
    function deleteDatabaseDmg(id, currentRow)
    {
        // set the data string
        var datastring = 'delete=dmg'+'&id=' + id;
        // make sure they want to do it
        if(confirm("Sure you want to delete this value? There is NO undo!"))
        {
            // ajax call
            $.ajax({
                type: "POST",
                url: "includes/controllers/uxrDmgsController.inc.php",
                data: datastring,
                success: function()
                {
                    currentRow.parent().remove();
                    dmgsCount--;
                }
             });
             
        }
        // Stop the page from refreshing
        return false;
    }
    
    
    
});


// TEST FUNCTIONS



// Get all the demographic rows for a specific cardsort
// Type must be uppercase to make the correct url
// Types can be: Card, Cardsort, Category and Dmgs
function displayDatabaseValues(type, cs_id)
{
    var datastring = 'rows='+type+'&cs_id='+cs_id;

    // ajax call
    $.ajax({
        type: "POST",
        url: "includes/controllers/uxr"+type+"Controller.inc.php",
        data: datastring,
        success: function(data)
        {
            // Parse the JSON data
            var msg = jQuery.parseJSON(data);

            // Assign a new value to error, using the msg object
            csError = msg.error;
            csMessage = msg.message;

            if (!(jQuery.isEmptyObject(csMessage)))
            {

            }
        }
     });
}


// Add Demographics display function
function showAddedDemographics2(dmgsCount, dmg_id, dmg_label, dmg_type)
{
    if (dmgsCount === 0)
    {
        $('.noDmgs').show();
    }
    else
    {
        $('.noDmgs').hide();
        var type = "Dmg";

        var objectArray = displayDatabaseValues(type, cs_id);
        console.log(objectArray);

        // $('<tr id='+dmg_id+'><td>'+dmg_label+'</td><td>'+dmg_type+'</td><td class="dmg_delete">X</td></tr>').appendTo('#dmgAdditions');
    }
}