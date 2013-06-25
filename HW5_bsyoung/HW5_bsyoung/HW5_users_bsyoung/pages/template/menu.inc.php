<ul class='mainNav'>
        <li><a href="<?php echo BasePath; ?>home">Home</a></li>       
       
        
        <?php if(auth::getSession('loggedin') == True){ ?>            
                   
                <li><a href="<?php echo BasePath; ?>member">Members</a></li>   
                <li><a href="<?php echo BasePath; ?>member/logout">Log Out</a></li>
        <?php }else{ ?>
                
                <li><a href="<?php echo BasePath; ?>register">Register</a></li>
                <li><a href="<?php echo BasePath; ?>login">Log In</a></li>
        <?php }; ?>
    </ul>
<div class='clearfix'></div>