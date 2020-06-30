<?php
ob_start();
$page_title = 'Signaler ';
require_once('../includes/load.php');
$a_antibody = find_by_id('anticorps', (int)$_GET['id'], 'IdentifiantA');
if (!$antibody) {
    $session->msg("d", "Anticorps non trouvé .");
    redirect('antibodies_user.php');
}
?>

<?php
if(isset($_POST['warning-type'])){
    $warning_type = remove_junk($db->escape($_POST['warning-type']));
    $project_ID=  $_SESSION['project-id'];
    $antibody_ID = $a_antibody['IdentifiantA'];
    $warning_massage = (empty($_POST['warning-message'])) ?
        '' : remove_junk($db->escape($_POST['warning-message']));
    $warning_date=date('yy-m-d');
    $query= "INSERT INTO signaler(DateSignalement,IdentifiantA,IdentifiantP,commentaire,typeSignalement) VALUES
            ('{$warning_date}','{$antibody_ID}','{$project_ID}', '{$warning_massage}','{$warning_type}')";
    if ($db->query($query)) {
        //sucess
        $session->msg('s', "Message envoyé. ");
        redirect('antibodies_user.php', false);
    } else {
        //failed
        $session->msg('d', "erreur.");
        redirect('antibodies_user.php', false);
    }
}else {
    $session->msg("d", "Il manque des renseignements");
    redirect('alerter_antibody.php', false);
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

