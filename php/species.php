<?php ob_start();
$page_title = 'Espèces';
require_once('../includes/load.php');
$all_species = find_all_species();
?>
<?php
if(isset($_POST['add_species'])){
    $req_field = array('species_name');
    validate_fields($req_field);
    $species_name = remove_junk($db->escape($_POST['species_name']));
    $species = find_by_field('especes',$species_name,'LibelleEsp');
    if (empty($species)){
        if(empty($errors)){
            $sql  = "INSERT INTO especes (LibelleEsp) VALUES ('{$species_name}')";
            if($db->query($sql)){
                $session->msg("s", "Espèce ajoutée ");
                redirect('species.php',false);
            } else {
                $session->msg("d", "L'ajout a échoué.");
                redirect('species.php',false);
            }
        } else {
            $session->msg("d", $errors);
            redirect('species.php',false);
        }
    }else {$session->msg("d", "Cette espèce existe déja . entrer une autre .");
        redirect('species.php',false);
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
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Espèces</span>
                    </strong>
                </div>
                <div class="panel-body clearfix">
                    <table class="table table-bordered table-hover"id="JS-data-table-species">
                        <thead>
                        <tr>
                            <th class="text-center">Espèces</th>
                            <th class="text-center" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_species as $species):?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($species['LibelleEsp'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-xs btn-danger" title="Remove"
                                           data-href="delete_species.php?IdentifiantEsp=
                                       <?php echo (int)$species['IdentifiantEsp'];?>" data-toggle="modal"
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
                        <span>Nouveau espèce</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" name="species_name" placeholder="Espèce Libellé">
                        </div>
                        <button type="submit" name="add_species" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>