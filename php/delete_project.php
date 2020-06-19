<?php ob_start();
require_once('../includes/load.php');
?>
<?php
$project = find_by_id('projets', (int)$_GET['IdentifiantP'], 'IdentifiantP');
if (!$project) {
    $session->msg("d", "projet non trouvé .");
    redirect('projects.php');
}
?>
<?php
$delete_id = delete_by_id('projets', (int)$project['IdentifiantP'], 'IdentifiantP');
if ($delete_id) {
    $session->msg("s", "projet supprimé.");
    redirect('projects.php');
} else {
    $session->msg("d", "La suppression a échoué.");
    redirect('projects.php');
}
?>
