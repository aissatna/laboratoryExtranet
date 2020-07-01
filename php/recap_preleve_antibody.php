<?php
ob_start();
$page_title = 'Prélèvement';
require_once('../includes/load.php');
if (isset($_POST['preleve'])){
    if (isset($_POST['quantitesP'])){
        $quantitesP=$_POST['quantitesP'];
        $_SESSION['quantitesP']=$_POST['quantitesP'];
    }
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
                    <span>Validation du prélèvement </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="valider_prelevement.php" class="clearfix">
                    <div class="form-group">
                        <label for="provider-name" class="control-label"><strong>Equipe :</strong> </label>
                        <?php $team = find_by_id('equipes', (int)$_SESSION['team-id'], 'IdentifiantE');?>
                        <?php echo first_character($team['NomE']) ; ?>
                    </div>
                    <div class="form-group">
                        <label for="provider-name" class="control-label"><strong>Projet :</strong> </label>
                        <?php $project = find_by_id('projets', (int)$_SESSION['project-id'], 'IdentifiantP');?>
                       <?php echo first_character($project['NomP']) ; ?>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Anticorps</th>
                                <th class="text-center">Quantité a prélevé (μL)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($_SESSION['$antibodyIDs'] as $key=>$antibodyID): ?>
                                <?php $antibody = find_by_id('anticorps', $antibodyID, 'IdentifiantA');?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo first_character($antibody['DesignationA'])?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $quantitesP[$key] ?>
                                    </td>
                                </tr>
                            <?php  endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group clearfix">
                        <button type="submit" name="valider" class="btn btn-info">Valider </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>
