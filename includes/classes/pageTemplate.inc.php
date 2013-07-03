<?php


class PageTemplate {

    //storages all vars in here 
    //until rendering the page
    private $vars = array();
    
    //loads the vars array with set
    public function __set($name, $value) {
        //creates a storage array for variables
        //to be passed to the view
        $this->vars[$name] = $value;
    }
    
    //renders the view and passes vars into views page 
    //call vars by key name
    public function render($file, $template){
        
        //pass public vars into view page files
        //by key name, don't call array use key name as string  
        foreach ($this->vars as $key => $value)
        {
                 $$key = $value;
        }
        
        $filename = VIEW_PATH . $file . '.inc.php';          
        //If true is set use the template files        
        if ($template && file_exists($filename)== TRUE){
            //use the template files            
            require VIEW_PATH. 'templates/header.inc.php';
            require VIEW_PATH . $file . '.inc.php';
            require VIEW_PATH . 'templates/footer.inc.php';
        } else {
            //no template -- you will have to build the html file in the required file
            require VIEW_PATH . $file . '.inc.php';
        }
        
    }
            
    function __construct() {}
    

}