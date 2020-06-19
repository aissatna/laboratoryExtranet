<?php ob_start();
require_once('../includes/load.php');
?>
<?php
$antibody = find_by_id('anticorps', (int)$_GET['IdentifiantA'], 'IdentifiantA');
if (!$antibody) {
    $session->msg("d", "Anticorps non trouvé .");
    redirect('antibodies.php');
}
?>
<?php
$delete_id = delete_by_id('anticorps', (int)$antibody['IdentifiantA'], 'IdentifiantA');
if ($delete_id) {
    $session->msg("s", "anticorps supprimé.");
    redirect('antibodies.php');
} else {
    $session->msg("d", "La suppression a échoué.");
    redirect('antibodies.php');
}
?>