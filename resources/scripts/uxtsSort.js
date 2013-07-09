//JQUERY FOR UXTS Controllers

$(document).ready(function() 
{
    // CODE!!
    
    // Set the default for opensort columns
    var openSortColumns = 1;
    
    startOpenRefresh();
    
    // FUNCTIONS!!
    
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
        var add = "<ul id='openSortable"+openSortColumns+"' class='sortable sortableCol droptrue ui-sortable'></ul>";
        $(add).appendTo("#uxtsCatArea");
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