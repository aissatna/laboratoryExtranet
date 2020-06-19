<?php ob_start();
$page_title = 'Clones';
require_once('../includes/load.php');
$all_clones = find_all_clones();
?>
<?php
if (isset($_POST['add_clone'])) {
    $req_field = array('clone_name');
    validate_fields($req_field);
    $clone_name = remove_junk($db->escape($_POST['clone_name']));
    $clone = find_by_field('clones', $clone_name, 'LibelleC');
    if (empty($clone)) {
        if (empty($errors)) {
            $sql = "INSERT INTO clones (LibelleC) VALUES ('{$clone_name}')";
            if ($db->query($sql)) {
                $session->msg("s", "Clone ajouté ");
                redirect('clones.php', false);
            } else {
                $session->msg("d", "L'ajout a échoué.");
                redirect('clones.php', false);
            }
        } else {
            $session->msg("d", $errors);
            redirect('clones.php', false);
        }
    } else {
        $session->msg("d", "Ce clone existe déjà , entrer un autre .");
        redirect('clones.php', false);
    }
}

?>
<?php include_once('../layouts/header.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php echo display_msg($msg); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>clones</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover" id="JS-data-table-clones">
                        <thead>
                        <tr>

                            <th class="text-center">clones</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_clones as $clone): ?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($clone['LibelleC'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-xs btn-danger" title="Remove"
                                           data-href="delete_clone.php?IdentifiantC=
                                       <?php echo (int)$clone['IdentifiantC']; ?>" data-toggle="modal"
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
                            <input type="text" class="form-control" name="clone_name" placeholder="Clone Libellé">
                        </div>
                        <button type="submit" name="add_clone" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>