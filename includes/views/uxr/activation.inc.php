<?php

//ONLY USERS THAT HAVE LOGGED IN
//SUCCUSSFUL CAN TRY TO ACTIVATE THE ACCOUNT
//isset($_SESSION['loggedin'])
if (true) : ?>



    <header>
        Activate Your Account
    </header>
    <section>
        <form action="?url=login/activate" method="post">
            <label for="activate_av_code">Enter Your Activation Code</label>
            <input id="activate_av_code" name="activate_av_code" type="text"></input>
            <button >Active</button>
        </form>

    </section>

<?php endif; ?>

