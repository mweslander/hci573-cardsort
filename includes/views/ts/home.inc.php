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
                if($study)
                foreach ($study as $key => $value) {
                    
                    echo "<li><a href='?url=uxts/index/$key'>". $value . "</a></li>";
                }
            ?>
            </ul>
        </div>     
    </section>
    <section class='Controlls'>
        <h3>Controls</h3>
        <ul>
            <li><a href='' >Add New Card</a></li>
            <li><a href='' >Add New Catogry</a></li>
            <li><a href='' >Save for later</a></li>
            <li><a href='' >Finished</a></li>
            
        </ul>
    </section>
</section>


<?php
// THIRD
// We need our main content area that functions in conjunction with the sidebar

if(isset($card['StudyName'])){
    $studyName = $card['StudyName'];            
}else{
    $studyName ="";
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
                if(isset($card['label'])){
                    
                    echo "<ul class='sortable' class='droptrue'>";
                    foreach ($card['label'] as $value) {
                        
                        echo "<li class='ui-state-default'>$value</li>";
                        
                    }
                    echo '</ul>';
                }
                //Set Category headers
                if(isset($card['category'])){
                    $i = 2;              
                    foreach ($card['category'] as $value) {   
                        echo "<ul class='sortable sortableCol' class='dropfalse'>";    
                        echo "<li class='ui-state-highlight'>$value</li>"; 
                        echo '</ul>';
                        $i++;
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