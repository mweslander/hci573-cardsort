<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Page {

    public $title;
    public $vars = array();
    
    //sets nothing to happen on construct
    public function __construct() {}

    public function render($name, $template = True) {
        //pass public vars into page files        
        $title =  $this->title;
        $vars = $this->vars;
        
        //True sets the page's template
        if ($template){
            //use the template files
            require 'pages/template/header.inc.php';
            require $name . '.inc.php';
            require 'pages/template/footer.inc.php';
        } else {
            //no template -- you will have to build the html file in the required file
            require $name . '.inc.php';
        }
    }
    
    public function set($key,$value){
        $this->vars[$key] = $value;
    }
    public function get($key){
        
        return $this->vars[$key];
    }
    
}  
// ending php tag omitted
