<?php
require_once('../includes/load.php');
if ($_POST['antibodyID']) {
    $antibodyID = $_POST['antibodyID']; //escape string
    //echo $antibodyID;
} else {
    echo 'error';
}
$antibody = find_by_id('anticorps', $antibodyID, 'IdentifiantA');
?>
<span><?php echo first_character($antibody['DesignationA']) ?></span>


