<?php
/*
**Homework 5: The task for this part of Homework 5 is to create a basic but functioning user management system for your project. Your site should enable a user to register an account, log in and log out. To get you started, the task can be broken down as follows:

[1 pt] Write an install.php script that creates a user table. You can choose the fields of the table. A bare minimum would be username, email and passowrd (in addition to the primary key field). Once again, use database "hci573" with user "hci573" and password "hci573". Your table's name should be unique (use netid as part of it) and different from the previous one that you used. 
[2 pt] Your site should have 4 areas -- the main area (i.e., index.php) with a welcome message, a register area, and a login area. It's ok to make the login area start by default as long as there is a link from it to the register user page. 
[2 pt] Write a register.php page that can be used to add a new user. Your registration page should sanitize the user's input. For example, I shouldn't be allowed to enter "adfasfad" as an email. At a minimum, your page should check that the user doesn't exist before adding them to the database. Activating the user is optional (see below). 
[2 pt] Upon logging in, the user should see their name and email on the page (you can do that by redirecting them or through PHP code in the main/log in pages). You should use a function similar to the secure_page() in order to start the session. 
[1 pt] Upon logging out, the session should be destroyed. 
[2 pts] Comments, readability and file structure


For extra credit:

[2 pt] Use CSS to make it look really nice. Say you did so in the "About" page of the site. 
[1 pt] Add something to the functionality of the registration and login scripts that is needed for your project. Explain what you added in an "About" page that I can navigate to from the main area. 
[1 pt] Upon logging out, save the time of logging out for that particular user in the SQL table. 
[1 pt] Use SQL encryption to store the user's email and then decrypt it when you need to show it on the login page. 

**Submit this assignment through the BlackBoard website, and ensure that the site is in a folder HW5_users_netid/ which is inside a folder called HW5_netid/. Compress the whole submission as HW5_netid.zip and then submit it.

NOTE: If you're using constants to define the site's base URL, you may have to change it to something like:
define ("BASE", "http://".$_SERVER['HTTP_HOST']."/HCI573/HW5_netid/HW5_users_netid");

** You CAN use PARTS of the secure user system, however, it is expected that you will modify it and are not simply resubmitting the code that has been provided to you.  Submitting an exact version of the code sets provided for class will result in a 0 grade.

*/
//END INSTRUCTIONS
?>
<html>
<head>
<script language="JavaScript" type="text/javascript" src="jquery-1.6.1.min.js"></script>
<script language="JavaScript" type="text/javascript" src="jquery.validate.js"></script>
<script>
$(document).ready(function(){
$("#your_form_id").validate();
});
</script>
</head>
<body>

<p>Put your form here</p>

</body>
</html>