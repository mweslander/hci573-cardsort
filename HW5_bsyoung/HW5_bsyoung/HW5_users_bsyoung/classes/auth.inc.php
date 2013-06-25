<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class auth {

    public static function initSession() {
        session_start();
    }

    public static function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function getSession($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public static function destroySession() {
        //unset session befre destroy
        $olduser = $_SESSION['loggedin'];
        unset($_SESSION['loggedin']);
        unset($_SESSION['username']);
//        unset($_SESSION['email']);
        session_unset();
        session_destroy();
    }

    
    
    
    
    
    
    
    
    
    
    /*
     * Check if user is admin
     * userlevel = 1 anon ... 5 Admin
     */

    public function isAdmin() {
        if (isset($_SESSION['userLevel']) && $_SESSION['userLevel'] >= 5) {
            return TRUE;
        } else {
            return False;
        }
    }

}

// ending php tag omitted