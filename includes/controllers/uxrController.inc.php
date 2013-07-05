<?php

class UxrController extends Basecontroller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //check SESSION before loading SECURE PAGE
        //Check session['loggedin'] and session['activated']
        $loggedin = AuthSession::getSession('loggedin');
        $activated = AuthSession::getSession('activated');
        if ($activated == TRUE && $loggedin == TRUE) {
            $this->_pageTemplate->title = 'UXR Page';
            $this->_pageTemplate->render('/uxr/home', TRUE);
        } else {
            echo " you haven't logged in";
        }
    }

}