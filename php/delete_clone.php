<?php ob_start();
require_once('../includes/load.php');
?>
<?php
echo $_GET['IdentifiantC'];
$clone = find_by_id('clones',(int)$_GET['IdentifiantC'],'IdentifiantC');
if(!$clone){
    $session->msg("d","Clone non trouvé .");
    redirect('clones.php');
}
?>
<?php
$delete_id = delete_by_id('clones',(int)$clone['IdentifiantC'],'IdentifiantC');
if($delete_id){
    $session->msg("s","clone supprimé.");
    redirect('clones.php');
} else {
    $session->msg("d","La suppression a échoué.");
    redirect('clones.php');
}
?>