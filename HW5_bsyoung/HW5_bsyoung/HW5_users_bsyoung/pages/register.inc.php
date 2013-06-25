<?php //this page is useing a template set in its controller    ?>
<div id="mainContent">    
    <section id="errorMessage"></section>
    <section>
        <header><h3>Register to become a user!</h3></header>
        <form name="frmRegister" class='frm' action="register/register" method="post">
            <div class='profile Box'>                                  
                <label for="txtLoginName">Username</label>
                <input type="text" id="txtLoginName" name="txtLoginName"></input>
                
                <label for="txtLoginEmail">Email</label> 
                <input type="text" id="txtLoginEmail" name="txtLoginEmail"></input> 
                
                <label for="pssLoginPass">Password</label>
                <input type="password" id="pssLoginPass" name="pssLoginPass"></input>
               
                <label for="pssLoginCFPass">Confirm Password</label>
                <input type="password" id="pssLoginCFPass" name="pssLoginCFPass"></input>
                 
            <button id="btnReg" name="submit" >Register</button>             
        </form>
    </section>
</div>



