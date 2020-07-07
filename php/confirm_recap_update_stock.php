<?php
ob_start();
require_once('../includes/load.php');
require_once('../libs/vendor/autoload.php');
// Récupération de données en session
$IdentifiantA = $_SESSION["IdentifiantA"];
$providername = $_SESSION["provider-name"];
$tubesnumber = $_SESSION["tubes-number"];
$tubesize = $_SESSION["tube_size"];
$expirationdate = $_SESSION['expiration-date'];
$volumeF = $_SESSION['volumeF'];
?>

<?php if (isset($_POST['valider'])) {
    if (empty($errors)) {
        $MAx_id_lot = find_max_id('lots', 'identifiantL');
        $id_lot = 1 + $MAx_id_lot['MaxId'];
        $sql_lot = "INSERT INTO lots (IdentifiantL ,DatePeremption) VALUES ($id_lot,'{$expirationdate}')";
        if ($db->query($sql_lot)) {
            $MAx_id_tube = find_max_id('tubes', 'referenceT');
            $MAx_id_lot = find_max_id('lots', 'identifiantL');
            for ($i = 1; $i <= $tubesnumber; $i++) {
                $id_tube = $i + $MAx_id_tube['MaxId'];
                $v = $volumeF[$i - 1];
                $sql_tube = "INSERT INTO tubes (ReferenceT ,IdentifiantL ,tailleT,EtatTube,IdentifiantA,Volume) VALUES ($id_tube,'{$MAx_id_lot['MaxId']}' , '{$tubesize}' ,'ferme','$IdentifiantA','$v')";
                $db->query($sql_tube);
                $sql_fournir = "INSERT INTO fournir (referenceT,identifiantA, identifiantF, quantiteLiv) VALUES ('$id_tube' , '$IdentifiantA','$providername','$v')";
                $db->query($sql_fournir);
            }
            $antibody = find_by_id('anticorps', (int)$IdentifiantA, 'IdentifiantA');
            $seuil = $antibody['SeuilAlerte'];
            $quantite_stock = find_quantity_stock($IdentifiantA);
            $Etat = verification_stock($seuil, $quantite_stock[0]['QuantiteStock']);
            update_availibility_stock($Etat, $IdentifiantA);

            /*------------- prepare and print recap---------------*/
            $provider = find_by_id('fournisseurs', (int)$providername, 'IdentifiantF');
            $data_pdf = '<h3 style="text-align: center"> Récapitulatif de la mise à jour </h3> <br/>';
            $data_pdf .= '<strong>Designation de l\'anticorps : </strong>' . $antibody['DesignationA'] . '<br/>';
            $data_pdf .= '<strong>Nom du fournisseur  : </strong>' . $provider['RaisonSocialeF'] . '<br/>';
            $data_pdf .= '<strong>Nombre de tubes reçus : </strong>' . $tubesnumber . '<br/>';
            $data_pdf .= '<strong>Taille tube : </strong>' . $tubesize . ' μL ' . '<br/>';
            $data_pdf .= '<strong>Date de péremption : </strong>' . $expirationdate . '<br/>';
            $data_pdf .= '<strong>Informations tubes :  </strong><br/>';
            $data_pdf .= '<table style="margin: 20px;border: 1px solid black;width: 100%; border-collapse: collapse">
                            <thead>
                            <tr>
                                <th style="text-align: center;border: 1px solid black">Réference tube</th>
                                <th style="text-align: center;border: 1px solid black;">Volume fourni (μL)</th>
                            </tr>
                            </thead>
                             <tbody>';
            for ($i = 1; $i <= $tubesnumber; $i++) {
                $Ref_tube = $i + $MAx_id['MaxId'];
                $data_pdf .= '<tr><td style="text-align: center;border: 1px solid black;">' . $Ref_tube . '</td>';
                $data_pdf .= '<td style="text-align: center;border: 1px solid black;">' . $volumeF[$i - 1] . '</td></tr>';

            }
            $data_pdf .= '</tbody></table>';
            /*------ print recap.pdf------*/
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($data_pdf);
            $mpdf->Output('Récapitulatif.pdf', 'D');

            //sucess message
            $session->msg('s', "Mise à jour de stock réussi. ");
        } else {
            $session->msg("d", "L'ajout de lot a échoué.");
            redirect('recap_update_stock.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('recap_update_stock.php', false);
    }

}

?>
