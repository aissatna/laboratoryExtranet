<?php ob_start();
$page_title = 'Anticorps';
require_once('../includes/load.php');
$all_antibodies = find_all_antibodies();
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
                    <span>Anticorps</span>
                </strong>
                <div class="pull-right">
                    <a href="add_antibody.php" class="btn btn-primary">Nouveau anticorps</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="JS-data-table-antibodies">
                        <thead>
                        <tr>
                            <th class="text-center">Désignation</th>
                            <th class="text-center">Fournisseur</th>
                            <th class="text-center">Quantité stockée (μL)</th>
                            <th class="text-center">Seuil alerte (μL)</th>
                            <th class="text-center">Etat stock </th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_antibodies as $antibody): ?>
                            <tr>
                                <td class="text-center">
                                    <a href="#" data-id="<?php echo (int)$antibody['IdentifiantA'];?>" data-toggle="modal"
                                       data-target="#info-modal"> <?php echo first_character($antibody['DesignationA']) ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?php if (empty($antibody['SiteWebF'])): ?>
                                        <?php echo first_character($antibody['RaisonSocialeF']);?>
                                    <?php else: ?>
                                        <a href="<?php echo $antibody['SiteWebF']; ?>" target="_blank">
                                            <?php echo first_character($antibody['RaisonSocialeF']) ; ?></a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $antibody['QuantiteStock']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $antibody['SeuilAlerte']; ?>
                                </td>
                                <td class="text-center">
                                    <?php switch ($antibody['EtatStockA']):case "Bon": ?>
                                        <span class="label label-success"><?php echo $antibody['EtatStockA']; ?></span>
                                        <?php break; ?>
                                    <?php case "Risque": ?>
                                        <span class="label label-warning"><?php echo $antibody['EtatStockA']; ?></span>
                                        <?php break; ?>
                                    <?php case "Rupture": ?>
                                        <span class="label label-danger"><?php echo $antibody['EtatStockA']; ?></span>
                                        <?php break; ?>
                                    <?php case "Signaler": ?>
                                        <span class="label label-info"><?php echo $antibody['EtatStockA']; ?></span>
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="details_antibody.php?IdentifiantA=<?php echo (int)$antibody['IdentifiantA']; ?>"
                                           class="btn btn-sm btn-info" data-toggle="tooltip" title="Details">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a>
                                        <a href="edit_stock.php?IdentifiantA=<?php echo (int)$antibody['IdentifiantA']; ?>"
                                           class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Remove"
                                           data-href="delete_antibody.php?IdentifiantA=
                                       <?php echo (int)$antibody['IdentifiantA']; ?>" data-toggle="modal"
                                           data-target="#delete-modal"><i class="glyphicon glyphicon-remove"></i>
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
<?php include_once('../layouts/infos-modal.php'); ?>
<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>
