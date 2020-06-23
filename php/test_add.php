<?php

// Check if form is submitted successfully
if(isset($_POST["add-antibody"]))
{
    // Check if any option is selected
    if(isset($_POST["antibody-especes"]))
    {
        // Retrieving each selected option
        foreach ($_POST['antibody-especes'] as $espece)
            print "You selected $espece<br/>";
    }
    else
        echo "Select an option first !!";
}
?>