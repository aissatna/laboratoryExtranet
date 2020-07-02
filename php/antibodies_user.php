<?php ob_start();
$page_title = 'Anticorps';
require_once('../includes/load.php');
$all_antibodies = find_all_antibodies_user();
?>
<?php
if (isset($_POST["next"])) {
    if (isset($_POST['team-id']) && $_POST['project-id']) {
        $_SESSION['team-id'] = $_POST['team-id'];
        $_SESSION['project-id'] = $_POST['project-id'];

    } else {
        $session->msg("d", 'field can\'t be blank');
        redirect('home_user.php', false);
    }
}
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
            </div>
            <div class="panel-body">
                <form name="antibodies-user-form" id="antibodies-user-form" action="">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="JS-data-table-antibodies-user">
                            <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Désignation</th>
                                <th class="text-center">Fournisseur</th>
                                <th class="text-center">Etat stock </th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_antibodies as $antibody): ?>
                                <tr>
                                    <td class="text-center">
							        <span class="antibody-checkbox">
								        <input type="checkbox" name="antibody"
                                               value="<?php echo $antibody['IdentifiantA'];?>">
								        <label></label>
						        	</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-id="<?php echo (int)$antibody['IdentifiantA'];?>" data-toggle="modal"
                                           data-target="#info-modal"> <?php echo first_character($antibody['DesignationA']) ?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php echo first_character($antibody['RaisonSocialeF']); ?>
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
                                            <a href="alerter_antibody.php?id=<?php echo (int)$antibody['IdentifiantA']; ?>"
                                               class="btn btn-sm btn-warning" data-toggle="tooltip" title="Alerter">
                                                <i class="glyphicon glyphicon-warning-sign"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group clearfix text-center">
                        <button type="submit" name="take-antibody" class="btn btn-info" >Prélever</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once('../layouts/infos-modal.php'); ?>
<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>
