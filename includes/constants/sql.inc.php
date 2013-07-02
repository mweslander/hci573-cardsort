<?php
// These are the database constants

// I used constants  and defined the table_name elsewhere
defined('DB_HOST')   ? null : define('DB_HOST', 'localhost');
defined('DB_USER')   ? null : define('DB_USER', 'hci573usort');
defined('DB_PASS')   ? null : define('DB_PASS', 'hci573usort');
defined('DB_NAME')   ? null : define('DB_NAME', 'hci573usort');

// SALTS
// User ID 
//defined('USER_ID_SALT') ? null : define('USER_ID_SALT', 'b1yerEb2W110z6e4qINQw36PKFMoAoz5');
// User Password
defined('USR_PWD_SALT') ? null : define('USR_PWD_SALT', '1G3MLgL1UTzpKu4QE2LX7naS0Z8JwvrR');
// User Email
defined('USR_EMAIL_SALT') ? null : define('USR_EMAIL_SALT', '435rjgS35rthEv6R472yMydwJSpr2P1p');
// Card Srt Password
defined('CS_PWD_SALT') ? null : define('CS_PWD_SALT', 'HePai3EaS7uc970fnTo38I7LCr48lAQs');
// Test Subject Email
defined('TS_EMAIL_SALT') ? null : define('TS_EMAIL_SALT', 'g6KCG79u7qJxDuG8Mx9gv1E59iepmV1G');

// PHP tag ommitted intentionally