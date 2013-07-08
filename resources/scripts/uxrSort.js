/* 
 * This file contains the javascript for the UXR section of the card sort
 */

$(document).ready(function(){
   
    // CODE!!!
    
    
    
    
    // FUNCTIONS!!!
    
    // Add a new category function
    function addCategory()
    {
        $('#registerForm').submit(function(event)
        {
            // Prevent the page from reloading
            event.preventDefault();
            // Get the variables
            var cardsortCategoryLabel = $('#cardsortCategoryLabel').val();
            
            
        });
    } // end of addCategory function
    
    // Add a new demographic function
    function addDemographic()
    {
        
    }
    
});

