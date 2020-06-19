<?php ob_start();
require_once('../includes/load.php');
?>
<?php
$team = find_by_id('equipes', (int)$_GET['IdentifiantE'], 'IdentifiantE');
if (!$team) {
    $session->msg("d", "Equipe non trouvée .");
    redirect('teams.php');
}
?>
<?php
$delete_id = delete_by_id('equipes', (int)$team['IdentifiantE'], 'IdentifiantE');
if ($delete_id) {
    $session->msg("s", "Equipe supprimée.");
    redirect('teams.php');
} else {
    $session->msg("d", "La suppression a échoué.");
    redirect('teams.php');
}
?>