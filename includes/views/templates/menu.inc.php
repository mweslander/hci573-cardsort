<?php

/*
 * Main Menu
 * 
 * Top login menu
 * 
 * @author Brett Young
 */

//Check for Session


if (AuthSession::getSession('loggedin') == TRUE){ ?>
    
  <div id='member_menu'>
      <ul>
          <li><a href='?url=login/logout'>LOGOUT</a></li>
          <li><a href='?url=uxr'>DASHBOARD</a></li>
          <li><a href='?url=uxts'>STUDIES</a></li>
      </ul>
  </div>
 <div class="clear"></div> 
<?php }else{ ;?>
    <div class="clear"></div> 
<?php } ;?>
    