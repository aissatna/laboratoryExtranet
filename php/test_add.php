<?php ob_start();
require_once('../includes/load.php');
?>

<?php
$antibody = find_by_id('anticorps', (int)$_GET['id'], 'IdentifiantA');
    if (!$antibody) {
        $session->msg("d", "Anticorps non trouvé .");
        redirect('antibodies_user.php');
    }
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
                    <span>Signaler anticorps </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="alerter_antibody.php?id=<?php echo (int)$a_antibody['IdentifiantA']; ?>" class="clearfix">
                    <div class="form-group">
                        <label for="warning-type" class="control-label"> Type d'alerte <span class="required-field">*</span></label>
                        <select name ="warning-type" id="warning-type" required class="form-control">
                            <option value="Manque de Stock">Manque de Stock</option>
                            <option value="Erreur de Stock">Erreur de Stock</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Message</label>
                        <textarea class="form-control" id="message" name="warning-message" rows="5" cols="5"></textarea>
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" name="alerter" class="btn btn-info">Alerter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>
