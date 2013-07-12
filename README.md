hci573-cardsort
===============

Card Sort Project for HCI 573

Authors: Michael Weslander
	 Brett Young
	 Ann Greazel

To install on your system:

• Create a user with global privileges in your MySQL database with username and password: hci573usort
    OR
  Open includes/constants/sql.inc.php and rename the username & password

• The global privileges are currently necessary because we have a script that installs the database

• Once installed, everything should work okay.

• We don't have the authentication working quite right yet, so you may have to go into the database to get the 
    authentication code for your given username