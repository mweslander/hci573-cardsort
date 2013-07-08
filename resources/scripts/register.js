/* 
 * This file is for Registration
 * 
 * it requires jQuery
 * 
 * @author Michael Weslander
 */

$(document).ready(function()
{
    // CODE
    // Set an empty error
    var regError = "";
    // And hide the empty error div
    $('#register_error').hide();
    
    // Set an empty message
    var regMessage = "";
    // And hide the empty message div
    $('#register_message').hide();
    
    // Get the registration ready for submission
    userRegistration();
    
    // FUNCTIONS
    
    
    // This is the User Registration function
    function userRegistration()
    {
//        $('#login').fadeTo("slow", 0, function(){
//            $(this).hide();
//            $('#register').fadeTo("slow", 1.0, function(){
//                $(this).show();
//            });        
//        });
        
        $('#registerForm').submit(function(event)
        {
            // Prevent the page from reloading
            event.preventDefault();
            // Get the variables
            var register_user_name = $('#register_user_name').val();
            var register_user_password = $('#register_user_password').val();
            var register_user_email = $('#register_user_email').val();
            var register_user_first_name = $('#register_user_first_name').val();
            var register_user_last_name = $('#register_user_last_name').val();
            // Create a datastring
            var datastring = "register_user_name="+register_user_name+"&register_user_password="+register_user_password+"&register_user_email="+register_user_email+"&register_user_first_name="+register_user_first_name+"&register_user_last_name="+register_user_last_name;
            // Make the ajax post
            $.ajax({
                type: "POST",
                //url: "includes/forms/registerForm.php",
                url: "includes/controllers/registerController.inc.php",
                data: datastring,
                success: function(data)
                {
                    // Parse the JSON data
                    var msg = jQuery.parseJSON(data);

                    // Assign a new value to error, using the msg object
                    regError = msg.error;
                    regMessage = msg.message;
                    // Check and display errors and messages
                    $('#register_error').html('<div></div>');
                    regErrorsAndMessages(regError, regMessage);
                }
            });
        });
    }
    
    function regErrorsAndMessages(error, message)
    {
        // Check to see if the error object is empty
        if(jQuery.isEmptyObject((error)))
        {
            // If it is, hide the error div
            $('#register_error').hide();
        }
        else
        {
            // Otherwise get them ready to display
            $('#register_error').show(); 
        }
        
        // Check to see if the message object is empty
        if(jQuery.isEmptyObject((message)))
        {
            // if it is, then hide it
            $('#register_message').hide();
        }
        else
        {
//            // Otherwise, display that message proudly
//            $('#register_message').show();
//            $('#register_message div').fadeTo("slow",1.0)
//                                .append('<p>'+ message +'</p>');
//            // Then hide the registration form
//            // And show the login
//            $('#register').fadeTo("slow", 0, function(){
//                $(this).hide();
//                $('#login').fadeTo("slow", 1.0, function(){
//                    $(this).show();
//                });        
//            });
        }

        // Userame too short or not entered
        if (error.username)
        {
            // Fade in the error
            $('#register_error div').fadeTo("slow",1.0)
                                    .append('<p>'+ error.username +'</p>');
            // Add a red border to the input
            $('#register_username').addClass('registration_input_error');
        }
        else
        {
            // Get rid of the red border to the input
            $('#register_username').removeClass('registration_input_error');
        }
        
        // Password is too short or not entered
        if (error.password)
        {
            // Fade in the error
            $('#register_error div').fadeTo("slow",1.0)
                                    .append('<p>'+ error.password +'</p>');
            // Add a red border to the input
            $('#register_password').addClass('registration_input_error');
        }
        else
        {
            // Get rid of the red border to the input
            $('#register_password').removeClass('registration_input_error');
        }
        
        // Email is invalid
        if (error.email)
        {
            // Fade in the error
            $('#register_error div').fadeTo("slow",1.0)
                                    .append('<p>'+ error.email +'</p>');
            // Add a red border to the input
            $('#register_email').addClass('registration_input_error');
        }
        else
        {
            // Get rid of the red border to the input
            $('#register_email').removeClass('registration_input_error');
        }
        
        // First Name is invalid
        if (error.first_name)
        {
            // Fade in the error
            $('#register_error div').fadeTo("slow",1.0)
                                    .append('<p>'+ error.first_name +'</p>');
            // Add a red border to the input
            $('#register_first_name').addClass('registration_input_error');
        }
        else
        {
            // Get rid of the red border to the input
            $('#register_first_name').removeClass('registration_input_error');
        }
        // First Name is invalid
        if (error.last_name)
        {
            // Fade in the error
            $('#register_error div').fadeTo("slow",1.0)
                                    .append('<p>'+ error.last_name +'</p>');
            // Add a red border to the input
            $('#register_last_name').addClass('registration_input_error');
        }
        else
        {
            // Get rid of the red border to the input
            $('#register_last_name').removeClass('registration_input_error');
        }
        
        // Duplicate Entry in database
        if (error.duplicate)
        {
            // Fade in the error
            $('#register_error div').fadeTo("slow",1.0)
                                .html('<p>'+ error.duplicate +'</p>');
            // Add a red border to the inputs
            $('#register_username').addClass('registration_input_error');
            $('#register_email').addClass('registration_input_error');
        }
        else
        {
            // Get rid of the red border to the inputs
            $('#register_username').removeClass('registration_input_error');
            $('#register_email').removeClass('registration_input_error');
        }
    }
    
});


$(document).ready(function(){
	$('#register-trigger').click(function(){
		$(this).next('#register-content').slideToggle();
		$(this).toggleClass('active');					
		
		if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
			else $(this).find('span').html('&#x25BC;')
		})
});

$(document).ready(function(){
	$('#demo-trigger').click(function(){
		$(this).next('#demo-content').slideToggle();
		$(this).toggleClass('active');					
		
		if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
			else $(this).find('span').html('&#x25BC;')
		})
});

$(document).ready(function(){
	$('#login-trigger').click(function(){
		$(this).next('#login-content').slideToggle();
		$(this).toggleClass('active');					
		
		if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
			else $(this).find('span').html('&#x25BC;')
		})
});