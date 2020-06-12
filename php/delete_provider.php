<?php ob_start();
require_once('../includes/load.php');
?>
<?php
echo $_GET['IdentifiantF'];
$provider = find_by_id('fournisseurs',(int)$_GET['IdentifiantF'],'IdentifiantF');
if(!$provider){
    $session->msg("d","Fournisseur non trouvée .");
    redirect('providers.php');
}
?>
<?php
$delete_id = delete_by_id('fournisseurs',(int)$provider['IdentifiantF'],'IdentifiantF');
if($delete_id){
    $session->msg("s","Fournisseur supprimé.");
    redirect('providers.php');
} else {
    $session->msg("d","La suppression a échoué.");
    redirect('providers.php');
}
?>
