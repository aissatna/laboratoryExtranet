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
    $isotype = find_by_field('types',$isotype_name,'LibelleType');
    if (empty($isotype)){
        if(empty($errors)){
            $sql  = "INSERT INTO types (LibelleType) VALUES ('{$isotype_name}')";
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
    }else {$session->msg("d", " Ce isotype existe déja , entrer un autre .");
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
                    <table class="table table-bordered table-hover" id= "JS-data-table-types">
                        <thead>
                        <tr>

                            <th class="text-center">Isotypes</th>
                            <th class="text-center" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_isotypes as $type):?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($type['LibelleType'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-xs btn-danger" title="Remove"
                                           data-href="delete_isotype.php?IdentifiantType=
                                       <?php echo (int)$type['IdentifiantType'];?>" data-toggle="modal"
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
<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>