<?php
ob_start();
$page_title = 'Prélèvement';
require_once('../includes/load.php');
require_once('../libs/vendor/autoload.php');
$antibodyIDs = $_SESSION['$antibodyIDs'];
$quantitesP = $_SESSION['quantitesP'];
$teamID = $_SESSION['team-id'];
$projectID = $_SESSION['project-id'];
if (isset($_POST['valider'])) {

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
    $_SESSION['$antibodyTubes']=$antibodyTubes;
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
}
if(isset($_POST['print'])){
    $antibodyTubes=$_SESSION['$antibodyTubes'];
    /*------------- prepare and print recap---------------*/
    $project = find_by_id('projets', (int)$projectID, 'IdentifiantP');
    $team= find_by_id('equipes', (int)$teamID, 'IdentifiantE');
    $data_pdf = '<h3 style="text-align: center"> Récapitulatif de prélèvement </h3> <br/>';
    $data_pdf .= '<strong>Equipe : </strong>' . first_character( $team['NomE']) . '<br/>';
    $data_pdf .= '<strong>Projet : </strong>' . first_character( $project['NomP']) . '<br/>';
    $data_pdf.=' <b style="color: #4d4d4d; font-weight: 500;">Veuillez respecter les indications suivantes pour chacun des prélèvements. </b><br/>';
     foreach ($antibodyTubes as $key => $value){
         $antibody = find_by_id('anticorps', $key, 'IdentifiantA');
         $data_pdf .= '<strong> Anticorps :'. first_character( $antibody['DesignationA']) .'</strong><br/>' ;
         $data_pdf .= '<table style="margin: 20px;border: 1px solid black;width: 100%; border-collapse: collapse">
                            <thead>
                            <tr>
                                <th style="text-align: center;border: 1px solid black">Réference tube</th>
                                <th style="text-align: center;border: 1px solid black;">Quantité a prélevé (μL)</th>
                            </tr>
                            </thead>
                             <tbody>';
         foreach ($value as $sub_key => $sub_val){
         $data_pdf .= '<tr><td style="text-align: center;border: 1px solid black;">' . $sub_key. '</td>';
         $data_pdf .= '<td style="text-align: center;border: 1px solid black;">' .$sub_val . '</td></tr>';

     }
         $data_pdf .= '</tbody></table>';

    }
    /*------ print recap.pdf------*/

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($data_pdf);
    $mpdf->Output('Récapitulatif.pdf', 'D');
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
                <form action="#" method="post">
                    <div class="form-group clearfix">
                        <a href="antibodies_user.php" class="btn btn-info"> Retour </a>
                        <button  name="print" class="btn btn-info pull-right">Imprimer </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>

