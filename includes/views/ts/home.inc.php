<?php

/*
 * Home view for the UXTS cardsort
 * 
 * 
 */

?>
<script>
    // jQuery UI sorting
    $(function() 
    {
        $( ".sortable" ).sortable(
        {
          connectWith: ".sortableCol",
          items: ":not(.immovable)"
        });//.disableSelection();
        
    });
    // jQuery UI datepicker
    $(function()
    {
        $( ".datepicker" ).datepicker();
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
                    foreach ($dmgs as $dmg)
                    {
                        echo "<label for='dmg". $dmg->id ."'>". $dmg->dmg_label . "</label>";
                        // This switch statement should really go in the controller
                        // but for the lack of time it is here.
                        switch($dmg->dmg_type)
                        {
                            case 'int':
                                echo "<input id='dmg". $dmg->id . "' class='dmgs dmg_" . $dmg->dmg_type . "' name='dmg". $dmg->id . "' type='number' />";
                                break;
                            case 'date':
                                echo "<input id='dmg". $dmg->id . "' class='dmgs dmg_" . $dmg->dmg_type . " datepicker' name='dmg". $dmg->id . "' type='text' />";
                                break;
                            default:
                                echo "<input id='dmg". $dmg->id . "' class='dmgs dmg_" . $dmg->dmg_type . "' name='dmg". $dmg->id . "' type='text' />";
                        }
                    }
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
                        echo "<div id='uxtsCardCol' >";
                        echo "<ul id='unsortedCards' class='sortable' class='droptrue'>";
                        echo "<label>Unsorted Cards:</label>";
                        foreach ($cards as $card) 
                        {                        
                            echo "<li class='ui-state-default uxtsCardLi'>";
                            echo $card->card_label;
                            echo "<input id='uxtsCard_" . $card->id . "' class='uxtsCard' type='hidden' value='". $card->id ."' />";
                            echo "</li>";
                        }
                        
                        echo '</ul>';
                        echo "</div>";
                    }

                    // Set Category headers
                    if(isset($categories))
                    {
                        echo "<div id='uxtsCatArea' class='uxtsClosedSort' >";
                        foreach ($categories as $category)
                        {
                            echo "<ul class='sortable sortableCol uxtsCatUl' class='dropfalse'>";    
                                // echo "<li class='ui-state-highlight immovable'>";
                                    echo "<label class='immovable'>Category Name: </label>";
                                    echo "<strong>" . $category->cat_label . "</strong>";
                                    echo "<input class='uxtsCatLabel' type='hidden' value='" . $category->cat_label . "' />";
                                // echo "</li>"; 
                            echo '</ul>';
                        }
                        echo "</div>";
                    }
                    // Otherwise if we don't have any categories
                    else
                    {
            ?>
                        <div id='uxtsCatArea' class='uxtsOpenSort' >
                            <ul id='openSortable1' class='sortable sortableCol droptrue uxtsCatUl'>
                                <label class="immovable">Category Name:</label>
                                <input class='uxtsCatLabel' id='openCat1' type='text' name='openCat1' />
                            </ul>
                        </div>
            <?php
                    }
             ?>

            <br class="clear" />
        </section>
    </section>
    <label for="uxtsFCSubmit">Have you completed the <em>About you</em> form and sorted all the cards?</label>
    <input id="uxtsFCSubmit" type="submit" value="Submit" />
</form>
<div class="clear"></div>
<?php


// FOURTH
// We need a footer. This is already included from the views/templates/footer.inc.php