<script>
    $(function() {
    $( ".sortable" ).sortable({
      connectWith: ".sortableCol"
    }).disableSelection();
  });
</script>
<form id="uxtsFullCardsort">
    
    <section id="uxtsControl">
        <header>
        <h2>About you</h2>
        </header>
        <section id="uxtsDmgs">
            <input id="uxtsCsId" type="hidden" name="uxtsCsId" value="<?php echo $cs_id; ?>" />
            <label for="uxtsEmail">Email</label> 
            <input id="uxtsEmail" type="email" name="uxtsEmail" />
            <?php 
                if (isset($dmgs))
                {
                    
                }
            ?>
        </section>
    </section>


    <?php
        if(!isset($studyName))
        {
            $studyName = "";            
        }
    ?>
    <section id="uxrView">
        <header>
            <h2><?php echo "Cardsort: ". $studyName ;?></h2>
        </header>
        <section class=''>
             <?php           
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

            <br class="clear" />
        </section>
    </section>
</form>
<div class="clear"></div>
<?php


// FOURTH
// We need a footer. This is already included from the views/templates/footer.inc.php