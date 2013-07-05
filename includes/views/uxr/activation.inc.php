<?php
//ONLY USERS THAT HAVE LOGGED IN
//SUCCUSSFUL CAN TRY TO ACTIVATE THE ACCOUNT
//isset($_SESSION['loggedin'])
/// IN PROGRESS
$loggedin = TRUE;

//if(AuthSession::getSession('loggedin')== TRUE){
//    $loggedin = True;
//}
if ($loggedin == TRUE) :
    
    ?>



    <header>
        Activate Your Account
    </header>
    <section id="activate">        
            <div id="message_error"> <!-- This is used for displaying errors returned from AJAX -->
                <div></div>
            </div>
            <form id='activationForm' action="?url=login/activate" method="post">
                <label for="activate_av_code">Enter Your Activation Code</label>
                <input id="activate_av_code" name="activate_av_code" type="text"></input>
                <button >Active</button>
            </form>

        </section>

    <?php endif; ?>
<?php 

?>
