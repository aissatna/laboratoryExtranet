<?php ob_start();
$page_title = 'Clones';
require_once('../includes/load.php');
$all_clones = find_all_clones();
?>
<?php
if(isset($_POST['add_clone'])){
    $req_field = array('clone_name');
    validate_fields($req_field);
    $clone_name = remove_junk($db->escape($_POST['clone_name']));
    if(empty($errors)){
        $sql  = "INSERT INTO especes (libelleC) VALUES ('{$clone_name}')";
        if($db->query($sql)){
            $session->msg("s", "Clone ajouté ");
            redirect('clones.php',false);
        } else {
            $session->msg("d", "L'ajout a échoué.");
            redirect('clones.php',false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('clones.php',false);
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
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th class="text-center">clones</th>
                            <th class="text-center" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_clones as $clone):?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($clone['libelleC'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="delete_clone.php?IdentifiantC=<?php echo (int)$clone['IdentifiantC'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                                            <span class="glyphicon glyphicon-trash"></span>
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

<?php include_once('../layouts/footer.php'); ?>