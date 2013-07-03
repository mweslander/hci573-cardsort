<?php

/*
 * Database Class
 * 
 * @author: Brett Young
 * 
 */

//require_once ('../constants/sql.inc.php');

class Database {

    // Database connection
    private static $db;
    private static $conn;
    
    // This function initializes a connection to the database
    public static function init() 
    {
        // If there is no database connection instantiated
        if (!self::$db) 
        {
            // Try connecting to the database
            try 
            {
                // PDO Connection. 
                // set the mysql host to our constant DB_HOST which is located in sql.inc.php
                // set the dbname to DB_NAME located in sql.inc.php
                // Changed UTF-8 to utf8
                $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
                // Set the static self database connection using the string above
                // And the constants DB_USER and DB_PASS, located in sql.inc.php
                self::$db = new PDO($dsn, DB_USER, DB_PASS);
                // Set $db attributes
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } 
            // If the connection doesn't work, then throw an exception
            catch (PDOException $e) 
            {
                die('Connection error:' . $e->getMessage());
            }
        }
        // Regardless, return the database connection or error
        return self::$db;
    }
    
    // This function creates an empty connection the database
    // It relies on the user having global privileges
    public static function initial_connection()
    {
        // If there is no database connection instantiated
        if (!self::$db) 
        {
            // Try connecting to the database
            try 
            {
                // PDO Connection. 
                // set the mysql host to our constant DB_HOST which is located in sql.inc.php
                // set the dbname to DB_NAME located in sql.inc.php
                // Changed UTF-8 to utf8
                $dsn = 'mysql:host=' . DB_HOST . ';charset=utf8';
                // Set the static self database connection using the string above
                // And the constants DB_USER and DB_PASS, located in sql.inc.php
                self::$conn = new PDO($dsn, DB_USER, DB_PASS);
                // Set $db attributes
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } 
            // If the connection doesn't work, then throw an exception
            catch (PDOException $e) 
            {
                die('Connection error:' . $e->getMessage());
            }
        }
        // Regardless, return the database connection or error
        return self::$conn;
    }
}

// ending php tag omitted