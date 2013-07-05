<?php

/*
 * Commons Class
 * 
 * This class mostly contains static methods to be used in other classes
 * 
 * @author Michael Weslander
 */

class Commons
{
    // filter string
    public static function filter_string($string)
    {
        // Strip tags
        $string = trim(htmlentities(strip_tags($string)));
        
        // Check for magic quotes
        if (get_magic_quotes_gpc())
        {
            $string = stripslashes($string);
        }
        // Return the string
        // Instead of using mysql escape string, we are binding
        // parameters in PDO
        return $string;
    }
    
    //Check for valid email
    public static function check_email($email) {
        return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
    }
    
}