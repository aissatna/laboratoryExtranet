<?php ob_start();
require_once('../includes/load.php');
?>
<?php
$isotype = find_by_id('types',(int)$_GET['IdentifiantType'],'IdentifiantType');
if(!$isotype){
    $session->msg("d","Isotype non trouvé .");
    redirect('isotypes.php');
}
?>
<?php
$delete_id = delete_by_id('types',(int)$isotype['IdentifiantType'],'IdentifiantType');
if($delete_id){
    $session->msg("s","Isotype supprimé.");
    redirect('isotypes.php');
} else {
    $session->msg("d","La suppression a échoué.");
    redirect('isotypes.php');
}
?>