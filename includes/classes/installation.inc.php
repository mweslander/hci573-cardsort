<?php

/*
 * Installation class
 * 
 * This page is the class for installing the database and tables.
 * It is used in the includes/config/install.php page
 * 
 * @author Michael Weslander
 */

require_once ('../constants/sql.inc.php');
require_once ('../classes/database.inc.php');


class Installation
{
    private $_connection;
    private $_database;

    public function __construct() 
    {
        // First establish an empty connection (no database)
        $this->_connection = Database::initial_connection();
        // Then install the database
        $this->_install_database();
        // Then let's get a proper connection to the database
        $this->_database = Database::init();
        //createTables if they don't exist
        // $this->_installTables();
    }

    // Install Database
    // This uses the private connection in order to create the database
    private function _install_database()
    {   
        // Check to see if database exists, if not, create it
        // DB_NAME is defined in sql.inc.php
        $db_sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
        // Try connecting to the database
        // and use the SQL call above to create the database
        try 
        {  
            // This uses an empty connection
            $this->_connection->exec($db_sql) 
            or die(print_r($this->_connection->errorInfo(), true));
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    private function _install_tables()
    {
        // USER POPULATED TABLES
        // =============================================================================

        // User's Table
        // Check to see if users table exists, if not, create it
        // The users table has these parameters: id, username, password, role, email, 
        // first_name, last_name, activation_code, num_logins & last_login
        // The id is the primary key, the username is straight, the password is hashed and encrypted
        // the role is an ENUM -- if you're not familiar, look it up, it's the best of both worlds, you call
        // it like a VARCHAR and it's stored like a tiny int. AWESOME!!! The email is encrypted, and the 
        // first and last names are varchars. 
        $users_sql = "CREATE TABLE IF NOT EXISTS usort_users (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                user_name varchar(220) NOT NULL DEFAULT '',
                user_password longblob,
                user_role ENUM ('visitor','uxr', 'admin') NOT NULL DEFAULT 'visitor',
                user_email longblob,
                first_name varchar(40),
                last_name varchar(50),
                activation_code int(10) NOT NULL DEFAULT '0',
                num_logins int(11) NOT NULL DEFAULT '0',
                last_login datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // This uses an empty connection
            $this->_database->exec($users_sql) 
            or die(print_r($this->_connection->errorInfo(), true));
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }

        // Card Sorts Table
        // Check to see if table exists, if not, create it
        // The card_sorts table has these parameters: id, user_id, cs_name, cs_type, & cs_password
        // The id is the primary key, the name is varchar, the type is enum, researcher_id
        // is an int and password is hashed and encrypted using the CS_PWD_SALT
        $cardsort_sql = "CREATE TABLE IF NOT EXISTS usort_cardsort (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                user_id bigint(20) UNSIGNED DEFAULT NULL,
                cs_name varchar(220) NOT NULL DEFAULT '',
                cs_type ENUM ('open','closed') NOT NULL DEFAULT 'open',
                cs_password longblob,
                cs_created datetime,
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // This uses an empty connection
            $this->_database->exec($cardsort_sql) 
            or die(print_r($this->_connection->errorInfo(), true));
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }

        
        // Cards Table
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, cs_id, card_label
        $cards_sql = "CREATE TABLE IF NOT EXISTS usort_cards (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                cs_id bigint(20) UNSIGNED DEFAULT NULL,
                card_label varchar(220) NOT NULL DEFAULT '',
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
        // Use the database connection to perform the query
        // Try connecting to the database
        try 
        {  
            // This uses an empty connection
            $this->_database->exec($cards_sql) 
            or die(print_r($this->_connection->errorInfo(), true));
        }
        // If the connection with the create database script didn't work
        // Then throw an error
        catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }


        // Demographics Table
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, cs_id, dmg_label, dmg_type
        $dmgs_sql = "CREATE TABLE IF NOT EXISTS usort_dmgs (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                cs_id bigint(20) UNSIGNED DEFAULT NULL,
                dmg_label varchar(220) NOT NULL DEFAULT '',
                dmg_type ENUM ('string','int', 'date') NOT NULL DEFAULT 'string',
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query


        // Categories Table
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, cs_id, cat_label
        $categories_sql = "CREATE TABLE IF NOT EXISTS usort_categories (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                cs_id bigint(20) UNSIGNED DEFAULT NULL,
                cat_label varchar(220) NOT NULL DEFAULT '',
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query


        // TEST SUBJECT POPULATED TABLES
        // =============================================================================


        // Test Subjects Table
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, cs_id, email
        // The email will be encrypted
        $test_subjects_sql = "CREATE TABLE IF NOT EXISTS usort_test_subjects (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                cs_id bigint(20) UNSIGNED DEFAULT NULL,
                ts_email longblob,
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query


        // Tests Table
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, ts_id, cs_finished
        $tests_sql = "CREATE TABLE IF NOT EXISTS usort_tests (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                ts_id bigint(20) UNSIGNED DEFAULT NULL,
                cs_finished datetime,
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query


        // Test Cards Table
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, test_id, card_id, & test_category
        $test_cards_sql = "CREATE TABLE IF NOT EXISTS usort_test_cards (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                test_id bigint(20) UNSIGNED DEFAULT NULL,
                card_id bigint(20) UNSIGNED DEFAULT NULL,
                test_category varchar(220) NOT NULL DEFAULT '',
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query



        // Test Demographics Tables


        // Demographics that are strings 
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, test_id, dmg_id, & dmg_value
        $test_cards_sql = "CREATE TABLE IF NOT EXISTS usort_test_dmg_strings (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                test_id bigint(20) UNSIGNED DEFAULT NULL,
                dmg_id bigint(20) UNSIGNED DEFAULT NULL,
                dmg_value varchar(220) NOT NULL DEFAULT '',
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query


        // Demographics that are ints 
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, test_id, dmg_id, & dmg_value
        $test_cards_sql = "CREATE TABLE IF NOT EXISTS usort_test_dmg_ints (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                test_id bigint(20) UNSIGNED DEFAULT NULL,
                dmg_id bigint(20) UNSIGNED DEFAULT NULL,
                dmg_value bigint(20),
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query


        // Demographics that are dates & times 
        // Check to see if table exists, if not, create it
        // The cards table has these parameters: id, test_id, dmg_id, & dmg_value
        $test_cards_sql = "CREATE TABLE IF NOT EXISTS usort_test_dmg_dates (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                test_id bigint(20) UNSIGNED DEFAULT NULL,
                dmg_id bigint(20) UNSIGNED DEFAULT NULL,
                dmg_value datetime,
                PRIMARY KEY (id)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        // Use the connection to perform the query
    }
    
    
}
