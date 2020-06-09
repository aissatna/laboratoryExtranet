<?php ob_start();
require_once('../includes/load.php');
?>
<?php
echo $_GET['IdentifiantEsp'];
$species = find_by_id('especes',(int)$_GET['IdentifiantEsp'],'IdentifiantEsp');
if(!$species){
    $session->msg("d","Espèce non trouvée .");
    redirect('species.php');
}
?>
<?php
$delete_id = delete_by_id('especes',(int)$species['IdentifiantEsp'],'IdentifiantEsp');
if($delete_id){
    $session->msg("s","Espèce supprimée.");
    redirect('species.php');
} else {
    $session->msg("d","La suppression a échoué.");
    redirect('species.php');
}
?>