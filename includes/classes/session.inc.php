<?php

/*
 * Session Authentication
 * 
 * @author Brett Young
 */

class AuthSession{
    //start new session
    public static function initSession() {
        session_start();
    }
    //Get session key Value pairs
    public static function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }
    //Get sessions keys by key
    public static function getSession($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }
    //Destroy session - unset session variables then destory session
    public static function destroySession() {
        //unset session befre destroy
        $olduser = $_SESSION['loggedin'];
        unset($_SESSION['loggedin']);
        unset($_SESSION['username']);
//        unset($_SESSION['email']);
        session_unset();
        session_destroy();
    }
    
    
    
    
}
