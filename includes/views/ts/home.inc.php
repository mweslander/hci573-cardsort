<script>
    $(function() {
    $( ".sortable" ).sortable({
      connectWith: ".sortableCol"
    }).disableSelection();
  });
</script>

<section id="uxtsControl">
    <header>
    <h2>Control Box</h2>
    </header>
    <section class="ActiveStudies">
        <h3>Your Studies</h3>
        <div id='studyList'>
            <ul>
            <?php  
                // DUMP THE TEST SUBJECTS STUDIES HERE
                //var_dump($study);
                if(isset($study)){
                foreach ($study as $key => $value) {
                    
                    echo "<li><a href='?url=uxts/index/$key'>". $value . "</a></li>";
                }
                }else{
                    echo "<li><a href='?url=uxr'>Start a study</a></li>"; 
                }
            ?>
            </ul>
        </div>     
    </section>
    <section class='Controlls'>
        <?php 
        //Hide Controls if there are now studys
        if(isset($study)){ ?>
            <h3>Controls</h3>
            <form id="uxtsAddCard">
                <input id='cardLabel' name='cardLabel' type='text'/>
                <input  type='submit' value='Add Card'/>                
            </form>
            <form id='uxtsAddCategory'>
                <input id='categoryLabel' name='categoryLabel' type='text'/>
                <input  type='submit'value='Add Category'/>               
            </form>

            <ul>
                <li><a href='' >Save for later</a></li>
                <li><a href='' >Finished</a></li>

            </ul>
        <?php }?>    
    </section>
</section>


<?php
// THIRD
// We need our main content area that functions in conjunction with the sidebar

if(!isset($studyName)){
    $studyName = "";            
}
?>
<section id="uxrView">
    <header>
        <h2><?php echo "Name of Study: ". $studyName ;?></h2>
    </header>
    <section class=''>
         <?php  
        // DUMP THE TEST SUBJECTS CARDS HERE 
        // After they click on a study in the side bar.
         // DUMP THE TEST SUBJECTS CARDS HERE
         //var_dump($card);
         //Set list of cards to page var card
         
                if(isset($cards))
                {
                   
                    echo "<ul class='sortable' class='droptrue'>";
                    foreach ($cards as $card) 
                    {                        
                        echo "<li class='ui-state-default'>$card->card_label</li>";                        
                    }
                    echo '</ul>';
                }
                
                //Set Category headers
                if(isset($categories))
                {
                    foreach ($categories as $category)
                    {
                        echo "<ul class='sortable sortableCol' class='dropfalse'>";    
                        echo "<li class='ui-state-highlight'>$category->cat_label</li>"; 
                        echo '</ul>';
                    }
                }
         ?>
        
        <br style="clear: both;" />
    </section>
</section>

<div class="clear"></div>
<?php


// FOURTH
// We need a footer. This is already included from the views/templates/footer.inc.php