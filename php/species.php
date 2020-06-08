<?php ob_start();
$page_title = 'Espèces';
require_once('../includes/load.php');
$all_species = find_all_species();
?>
<?php include_once('../layouts/header.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php echo display_msg($msg); ?>
        </div>
    </div>
    <div class="row">
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
                            <input type="text" class="form-control" name="species_name" placeholder="Espèce Libelle">
                        </div>
                        <button type="submit" name="add_species" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Espèces</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th class="text-center">Espèces</th>
                            <th class="text-center" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_species as $species):?>
                            <tr>
                                <td class="text-center"><?php echo remove_junk(ucfirst($species['libelleEsp'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
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
    </div>

<?php include_once('../layouts/footer.php'); ?>