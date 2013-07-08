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
    
    addCardsort();
    addCategory();
    addCard();
    addDemographic();
    
    showCardsortType('open');
    showCardsortName(0);
    
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
            
            console.log(datastring);
            $.ajax({
                type: "POST",
                //url: "includes/forms/registerForm.php",
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
            
            console.log(datastring);
            
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
                    
            console.log(datastring);
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
            var cardsortDemographicsLabel = $('#cardsortDemographicsLabel').val();
            var cardsortDemographicsType = $('input[name=demographicsType]:checked', '#uxrCardsortDemographics').val();
            var datastring = "add=demographic"+"&cs_id="+cs_id+"&demographics_label="+cardsortDemographicsLabel+"&demographics_type="+cardsortDemographicsType;
                    
            console.log(datastring);
        });
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
        }
        else
        {
            $('p > span','#uxrViewDetails').html("Open Sort");
        }
    }
    
});