<?php //this page is useing a template set in its controller   ?>

<div id="mainContent">
    <section id="errorMessage"> <?php; ?></section>
    <section>
        <header><h3>Sign in to see your member profile!</h3></header>
        <form name ='frmLogin' class="frm" action="login/logins" method="post">
            <div class='loginDetails'>
                <label for="name">Username</label>
                <input type="text" id="txtLoginName" name="txtLoginName"></input>

                <label for="pass">Password</label>
                <input type="password" id="pssLoginPass" name="pssLoginPass"></input>

                <button id="btnLogin" name="submit" >Login</button>    
            </div>
        </form>
    </section>
    <?php; ?>
</div>



