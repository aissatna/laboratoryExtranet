<?php ob_start();
$page_title = 'Tubes';
require_once('../includes/load.php');
$all_tubes = find_all_tubes((int)$_GET['IdentifiantA']);
?>
<?php include_once('../layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Tubes</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">Réference</th>
                        <th class="text-center">Volume</th>
                        <th class="text-center">Etat tube</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($all_tubes as $tube): ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $tube['referenceT']?>
                            </td>
                            <td class="text-center">
                                <?php echo $tube['volume']?>
                            </td>
                            <td class="text-center">
                                <?php echo first_character( $tube['EtatTube'])?>
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
