/* 
 * This file contains the javascript for the UXR section of the card sort
 */

$(document).ready(function(){
   
    // CODE!!!
    
    
    addCardsort();
    addCategory();
    
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
            var datastring = "user_id="+user_id+"&cardsort_name="+cardsort_name+"&cardsort_type="+cardsort_type;
            
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
            
            console.log(cardsortCategoryLabel);
        });
    } // end of addCategory function
    
    // Add a new demographic function
    function addDemographic()
    {
        
    }
    
});

