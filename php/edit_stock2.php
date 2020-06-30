<?php
ob_start();
$page_title = 'Editer Stock';
require_once('../includes/load.php');
$MAX_id = find_max_id('tubes', 'referenceT');
?>
<?php include_once('../layouts/header.php'); ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <h4>
                <?php echo display_msg($msg); ?>
            </h4>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row ">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Informations tubes </span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="recap_update_stock.php" class="clearfix">
                        <small>Les volumes insérés doivent être inférieurs ou égaux à la taille des tubes <span class="required-field"><?php echo  $_SESSION["tube_size"] .' μL';?> </span></small>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Réference</th>
                                <th class="text-center">Volume fourni <span class="required-field">*</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 1; $i <= $_SESSION ["tubes-number"]; $i++) { ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $i + $MAX_id['MaxId']; ?>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" class="form-control" name="volumeF[]" id="volumeF" required min='1' max =<?php echo  $_SESSION["tube_size"]; ?> >
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="form-group clearfix">
                            <button type="submit" name="edit-stock2" class="btn btn-info">Suivant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>



<?php include_once('../layouts/footer.php'); ?>
