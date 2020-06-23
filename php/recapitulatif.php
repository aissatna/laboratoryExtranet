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
//On verifie que les volumes fournu  sont bien entrées dans le formulaire et on les récupere
if (!empty($_POST['volumeF'])) {
    $volumeF = $_POST['volumeF'];
} else {
    $volumeF = "";
}

?>
<?php include_once('../layouts/header.php'); ?>

<div class="add-project-page">
    <div class="text-center">
        <h3>Récapitulatif du l'anticorps <?php $antibody = find_by_id('anticorps', (int)$IdentifiantA, 'IdentifiantA');
            echo $antibody['DesignationA']; ?></h3>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="confirm_recap.php" class="clearfix">
        <div class="form-group">
            <label for="provider-name" class="control-label"> Nom du fournisseur :</label>
            <?php echo $provider['RaisonSocialeF']; ?>
        </div>
        <div class="form-group">
            <label for="tubesnumber" class="control-label"> Nombre de tubes récu :</label>
            <?php echo $tubesnumber; ?>
        </div>
        <div class="form-group">
            <label for="tube_size" class="control-label"> Taille tube:</label>
            <?php echo $tubesize; ?>
        </div>
        <div class="form-group">
            <label for="expirationdate" class="control-label"> Date de péremption:</label>
            <?php echo $expirationdate; ?>
        </div>
        <div class="form-group">
            <label for="tube_informations" class="control-label"> Informations Tubes :</label>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">Réference</th>
                    <th class="text-center">Volume fournu</th>
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
            <button type="submit" name="valider" class="btn btn-info">Valider et imprimer</button>
        </div>
    </form>
</div>

<?php include_once('../layouts/footer.php'); ?>
