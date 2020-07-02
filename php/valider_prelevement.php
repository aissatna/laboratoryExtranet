<?php
ob_start();
$page_title = 'Prélèvement';
require_once('../includes/load.php');
if (isset($_POST['valider'])) {
    $antibodyIDs = $_SESSION['$antibodyIDs'];
    $quantitesP = $_SESSION['quantitesP'];
    $teamID = $_SESSION['team-id'];
    $projectID = $_SESSION['project-id'];
}
$antibodyTubes = array();
foreach ($antibodyIDs as $key => $antibodyID) {
    $referenceTubes = array();
    $quantites_a_preleve = $quantitesP[$key];
    while ($quantites_a_preleve <> 0) {
        $tube_antibody = find_tube_with_etat($antibodyID);
        $identifiantT = $tube_antibody[0]['ReferenceT'];
        $volume_tube = $tube_antibody[0]['Volume'];
        if ($quantites_a_preleve > $volume_tube) {
            $referenceTubes[$identifiantT] = $volume_tube;
            $quantites_a_preleve -= $volume_tube;
            update_tube_etat($identifiantT, $antibodyID, 'vide', '0');
        } else {
            $referenceTubes[$identifiantT] = $quantites_a_preleve;
            $volume_tube -= $quantites_a_preleve;
            update_tube_etat($identifiantT, $antibodyID, 'ouvert', $volume_tube);
            $quantites_a_preleve = 0;
        }

    }
    // save each references of tube
    $antibodyTubes[$antibodyID] = $referenceTubes;
    // Update stock  status
    $antibody = find_by_id('anticorps', (int)$antibodyID, 'IdentifiantA');
    $seuil = $antibody['SeuilAlerte'] ;
    $quantite_stock = find_quantity_stock($antibodyID) ;
    $Etat = verification_stock ($seuil ,$quantite_stock[0]['QuantiteStock']);
    update_availibility_stock ($Etat, $antibodyID);
    $datePrel=date("Y-m-d H:i:s");
    // Insert each utliser
    $sql= "INSERT INTO utiliser (IdentifiantP, IdentifiantA, DatePrelevement )
                            VALUES ('{$projectID}','{$antibodyID}','{$datePrel}')";
    if (!$db->query($sql)) {
        $session->msg("d", "Une erreur est survenue !! ");

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
                    <span>Récapitulatif du prélèvement </span>
                </strong>
            </div>
            <div class="panel-body">
                <b style="color: #4d4d4d; font-weight: 500;">Veuillez respecter les indications suivantes pour chacun des prélèvements. </b>
                <?php foreach ($antibodyTubes as $key => $value) : ?>
                    <?php $antibody = find_by_id('anticorps', $key, 'IdentifiantA'); ?>
                    <strong style="margin:15px 0; font-size: 15px;display: block;"> Anticorps : <?php echo $antibody['DesignationA'] ?></strong>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Réference tube</th>
                            <th class="text-center">Quantité a prélevé (μL)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($value as $sub_key => $sub_val): ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $sub_key ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $sub_val ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
                <div class="form-group clearfix">
                    <a href="antibodies_user.php" class="btn btn-info"> Retour </a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>

