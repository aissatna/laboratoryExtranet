<?php ob_start();
$page_title = 'Fluorochromes';
require_once('../includes/load.php');
$all_Fluorochromes = find_all_fluorochromes();
?>
<?php
if(isset($_POST['add_fluorochrome'])){
    $req_field = array('fluorochrome_name');
    validate_fields($req_field);
    $fluorochrome_name = remove_junk($db->escape($_POST['fluorochrome_name']));
    if(empty($errors)){
        $sql  = "INSERT INTO fluorochromes (LibelleFluo) VALUES ('{$fluorochrome_name}')";
        if($db->query($sql)){
            $session->msg("s", "Fluorochrome ajouté ");
            redirect('fluorochromes.php',false);
        } else {
            $session->msg("d", "L'ajout a échoué.");
            redirect('fluorochromes.php',false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('fluorochromes.php',false);
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
                        <span>Fluorochromes</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th class="text-center">Fluorochromes</th>
                            <th class="text-center" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_Fluorochromes as $fluorochrome):?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($fluorochrome['LibelleFluo'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="delete_fluorochrome.php?IdentifiantFluo=<?php echo (int)$fluorochrome['IdentifiantFluo'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
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
                        <span>Nouveau Fluorochrome</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fluorochrome_name" placeholder="Fluorochrome Libellé">
                        </div>
                        <button type="submit" name="add_fluorochrome" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once('../layouts/footer.php'); ?>