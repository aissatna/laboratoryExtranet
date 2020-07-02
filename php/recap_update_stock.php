<?php
ob_start();
$page_title = 'Editer Stock';
require_once('../includes/load.php');
$MAx_id = find_max_id('tubes', 'referenceT');
// Récupération de données en session
$IdentifiantA = $_SESSION["IdentifiantA"];
$providername = $_SESSION["provider-name"];
$tubesnumber = $_SESSION["tubes-number"];
$tubesize = $_SESSION["tube_size"];
$expirationdate = $_SESSION['expiration-date'];
//mettre en session les données necessaire pour la page suivante
$_SESSION ["volumeF"] = $_POST['volumeF'];
$volumeF = $_POST['volumeF'];
$provider = find_by_id('fournisseurs', (int)$providername, 'IdentifiantF');
?>
<?php
//On verifie que les volumes fourni  sont bien entrées dans le formulaire et on les récupere
if (!empty($_POST['volumeF'])) {
    $volumeF = $_POST['volumeF'];
} else {
    $volumeF = "";
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
                    <?php $antibody = find_by_id('anticorps',  (int)$IdentifiantA, 'IdentifiantA');?>
                    <span>Récapitulatif du l'anticorps : <?php echo $antibody['DesignationA']?></span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="confirm_recap_update_stock.php" class="clearfix">
                    <div class="form-group">
                        <label for="provider-name" class="control-label"> Nom du fournisseur :</label>
                       <strong><?php echo $provider['RaisonSocialeF']; ?></strong>
                    </div>
                    <div class="form-group">
                        <label for="tubesnumber" class="control-label"> Nombre de tubes reçus :</label>
                       <strong><?php echo $tubesnumber; ?></strong>
                    </div>
                    <div class="form-group">
                        <label for="tube_size" class="control-label"> Taille tube:</label>
                        <strong><?php echo $tubesize .'μL'; ?></strong>
                    </div>
                    <div class="form-group">
                        <label for="expirationdate" class="control-label"> Date de péremption:</label>
                       <strong><?php echo $expirationdate; ?></strong>
                    </div>
                    <div class="form-group">
                        <label for="tube_informations" class="control-label"> Informations tubes :</label>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Réference</th>
                                <th class="text-center">Volume fourni</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 1; $i <= $tubesnumber; $i++) { ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $i + $MAx_id['MaxId']; ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo $volumeF[$i - 1]; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group clearfix">
                        <button type="submit" name="valider" class="btn btn-info">Valider et télécharger</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>
