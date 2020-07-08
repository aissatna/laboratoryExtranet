<?php ob_start();
$page_title = 'Fournisseurs';
require_once('../includes/load.php');
$all_providers = find_all_providers();
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
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Fournisseurs</span>
                </strong>
                <div class="pull-right">
                    <a href="add_provider.php" class="btn btn-primary">Nouveau Fournisseur</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="JS-data-table-providers">
                        <thead>
                        <tr>
                            <th class="text-center">Raison sociale</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Téléphone</th>
                            <th class="text-center">Site Web</th>
                            <th class="text-center">Liste des prix</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_providers as $provider): ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo first_character($provider['RaisonSocialeF']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $provider['EmailF']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $provider['TelephoneF']; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo $provider['SiteWebF']; ?>"
                                       target="_blank"><?php echo $provider['SiteWebF']; ?></a>
                                </td>
                                <td class="text-center">
                                    <a href="../uploads/<?php echo $provider['ListeDesPrix']; ?>"
                                       download><?php echo $provider['ListeDesPrix']; ?></a>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-xs btn-danger" title="Remove"
                                           data-href="delete_provider.php?IdentifiantF=
                                       <?php echo (int)$provider['IdentifiantF']; ?>" data-toggle="modal"
                                           data-target="#delete-modal"><i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                        <a href="edit_provider.php?id=<?php echo (int)$provider['IdentifiantF']; ?>"
                                           class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                            <i class="glyphicon glyphicon-pencil"></i>
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
</div>

<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>
