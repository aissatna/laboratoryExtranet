<?php ob_start();
$page_title = 'All Group';
require_once('../includes/load.php');
$all_antibodies = find_all_antibodies();
?>
<?php include_once('../layouts/header.php'); ?>
<!--<div class="row">
    <div class="col-md-12">
        <?php /*echo display_msg($msg); */?>
    </div>
</div>
-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Anticorps</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
<!--                        <th class="text-center">Identifiant</th>-->
                        <th class="text-center">Désignation</th>
                        <th class="text-center">Quantité stock</th>
                        <th class="text-center">Seuil</th>
                        <th class="text-center">Etat stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($all_antibodies as $antibody): ?>
                    <tr>
                       <!-- <td class="text-center">
                            <?php /*echo $antibody['IdentifiantA']*/?>
                        </td>-->
                        <td class="text-center">
                            <?php echo $antibody['DesignationA']?>
                        </td>
                        <td class="text-center">
                            <?php echo $antibody['QuantiteStock']?>
                        </td>
                        <td class="text-center">
                            <?php echo $antibody['SeuilAlerte']?>
                        </td>
                        <td class="text-center">
                            <?php echo $antibody['EtatStockA']?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-info" data-toggle="tooltip" title="Details">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Remove">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('../layouts/footer.php'); ?>