<?php
//this page is useing a template set in its controller 
//make sure user has a session
if (isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) {
    ?>

    <div id="mainContent">
        <section id="errorMessage"> <?php; ?></section>
        <section>
            <header><h3>Welcome, this is your profile page</h3></header>

            <section id='userDetails' >
                <fieldset>
                    <header>
                        <h4>User Details:</h4>
                    </header>
                    <section>
                        <div class='userDetails'>
                            <label>Username: </label><span><?php echo $vars['username']; ?></span><br />
                            <label>Registered Email: </label><span><?php echo $vars['email']['user_email']; ?></span>
                        </div>
                    </section>
                </fieldset>
            </section>     
            <section id='additionalDetails' >
                <fieldset>
                    <header>
                        <h4>Additional Details:</h4>
                    </header>
                    <section>
                        <div class='userDetails'>
                            <label>Username: </label><span><?php  ?></span><br /><br />
                            <label>Registered Email: </label><span><?php  ?></span>
                        </div>
                    </section>
                </fieldset>
            </section>
        </section>
        <?php; ?>
    </div>












    <?php
} else {
    echo "denied access!";
}
?>



