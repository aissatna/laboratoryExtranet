<?php ob_start();
$page_title = 'Isotypes';
require_once('../includes/load.php');
$all_isotypes = find_all_isotypes();
?>
<?php
if(isset($_POST['add_isotype'])){
    $req_field = array('isotype_name');
    validate_fields($req_field);
    $isotype_name = remove_junk($db->escape($_POST['isotype_name']));
    if(empty($errors)){
        $sql  = "INSERT INTO types (libelleType) VALUES ('{$isotype_name}')";
        if($db->query($sql)){
            $session->msg("s", "Isotype ajouté ");
            redirect('isotypes.php',false);
        } else {
            $session->msg("d", "L'ajout a échoué.");
            redirect('isotypes.php',false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('isotypes.php',false);
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
                        <span>Isotypes</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th class="text-center">Isotypes</th>
                            <th class="text-center" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_isotypes as $type):?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($type['libelleType'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="delete_isotype.php?IdentifiantType=<?php echo (int)$type['IdentifiantType'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
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
                        <span>Nouveau Isotype</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" name="isotype_name" placeholder="Isotype Libellé">
                        </div>
                        <button type="submit" name="add_isotype" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once('../layouts/footer.php'); ?>