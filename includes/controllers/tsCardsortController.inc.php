<?php

/*
 * TsCardController class
 * 
 * This class handles AJAX calls for cards for a specific cardsort
 * 
 * @author Michael Weslander
 */

// This is how the classes are being called 
// Only instead of writing all of this out, Brett wrote an autoloader
// that goes through and fetches them for us


class TsCardsortController extends Basecontroller
{
    private $_model = 'CardsortModel';
    
    public function __construct() {
        // I don't think we really need to construct the Basecontroller here
        // We may not even need to extend the Basecontroller
        // The Basecontroller is creating a new page template, and this
        // particular page doesn't need a template per-se, or it might, I'm not
        // exactly sure. Basically I will be running a function that checks the
        // post data, sends it to the UserModel, gets info from the UserModel
        // then sends info back to the page that called it.
        // parent::__construct();        
    }
    
    // This goes to the database and gets the details of the cardsort
    public function cardsortDetails($cs_id = 0)
    {
        $cardsort = CardsortModel::find_by_id($cs_id);
        return $cardsort;
    }
}