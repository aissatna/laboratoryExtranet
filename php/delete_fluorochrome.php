<?php ob_start();
require_once('../includes/load.php');
?>
<?php
echo $_GET['IdentifiantFluo'];
$fluorochrome = find_by_id('fluorochromes',(int)$_GET['IdentifiantFluo'],'IdentifiantFluo');
if(!$fluorochrome){
    $session->msg("d","Fluorochrome non trouvée .");
    redirect('fluorochromes.php');
}
?>
<?php
$delete_id = delete_by_id('fluorochromes',(int)$fluorochrome['IdentifiantFluo'],'IdentifiantFluo');
if($delete_id){
    $session->msg("s","Fluorochrome supprimé.");
    redirect('fluorochromes.php');
} else {
    $session->msg("d","La suppression a échoué.");
    redirect('fluorochromes.php');
}
?>