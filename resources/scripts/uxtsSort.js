//JQUERY FOR UXTS Controllers

$(document).ready(function() {



    $('#uxtsAddCard').submit(function(event) {
// Prevent the page from reloading
        event.preventDefault();
        // Get the variables
        var url = window.location.search;
        var cs_id = url.split("/");
        if (cs_id[2]) {
            alert(cs_id[2]);
            var CardLabel = $('#cardLabel').val();
            var datastring = "add=card&cs_id="+cs_id[2]+"&card_label=" + CardLabel;
            //console.log(datastring);

            $.ajax({
// Post
                type: "POST",
                // To this location
                url: "?url=uxts/addCard",
                // The datastring defined above
                data: datastring,
                success: function(data)
                {
// Parse the JSON data
                    //var msg = jQuery.parseJSON(data);
                    
                   
                     window.location.reload(true);
                }
            }); // End of AJAX call
                
                
        } else {
            alert("YOU SHOULD BE HERE");
        }
        //Cheating
        $(document).ajaxStop(function(){
            window.location.reload(true);
        });

    });

    $('#uxtsAddCategory').submit(function(event) {
// Prevent the page from reloading
        event.preventDefault();
        // Get the variables
        var url = window.location.search;
        var cs_id = url.split("/");
        if (cs_id[2]) {
            alert(cs_id[2]);
            var CardLabel = $('#categoryLabel').val();
            var datastring = "add=category&cs_id="+cs_id[2]+"&category_label=" + CardLabel;
            //console.log(datastring);

            $.ajax({
// Post
                type: "POST",
                // To this location
                url: "?url=uxts/addCategory",
                // The datastring defined above
                data: datastring,
                success: function(data)
                {
// Parse the JSON data
                    //var msg = jQuery.parseJSON(data);
                    
                   
                     window.location.reload(true);
                }
            }); // End of AJAX call
                
                
        } else {
            alert("YOU SHOULD BE HERE");
        }
        //Cheating
        $(document).ajaxStop(function(){
            window.location.reload(true);
        });
    });

});


