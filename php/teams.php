<?php ob_start();
$page_title = 'Equipes';
require_once('../includes/load.php');
$all_teams = find_all_teams();
?>
<?php
if (isset($_POST['add_team'])) {
    $req_field = array('team_name');
    validate_fields($req_field);
    $team_name = remove_junk($db->escape($_POST['team_name']));
    $team = find_by_field('equipes', $team_name, 'NomE');
    if (empty($team)) {
        if (empty($errors)) {
            $sql = "INSERT INTO equipes (NomE)VALUES ('{$team_name}')";
            if ($db->query($sql)) {
                $session->msg("s", "Equipe ajoutée ");
                redirect('teams.php', false);
            } else {
                $session->msg("d", "L'ajout a échoué.");
                redirect('teams.php', false);
            }
        } else {
            $session->msg("d", $errors);
            redirect('teams.php', false);
        }
    } else {
        $session->msg("d", "Cette équipe existe déjà , entrer une autre .");
        redirect('teams.php', false);
    }
}

?>
<?php include_once('../layouts/header.php'); ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
            <h4>
                <?php echo display_msg($msg); ?>
            </h4>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Equipes</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover" id="JS-data-table-clones">
                        <thead>
                        <tr>

                            <th class="text-center">Equipes</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_teams as $team): ?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($team['NomE'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-xs btn-danger" title="Remove"
                                           data-href="delete_team.php?IdentifiantE=
                                       <?php echo (int)$team['IdentifiantE']; ?>" data-toggle="modal"
                                           data-target="#confirm-delete"><i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Nouveau clone</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" name="team_name" placeholder="Nom de l'équipe ">
                        </div>
                        <button type="submit" name="add_team" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>