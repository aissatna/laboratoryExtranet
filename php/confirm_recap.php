<?php
ob_start();
require_once('../includes/load.php');
// Récupération de données en session
$IdentifiantA=$_SESSION["IdentifiantA"] ;
$providername=$_SESSION["provider-name"] ;
$tubesnumber=$_SESSION["tubes-number"] ;
$tubesize=$_SESSION["tube_size"] ;
$expirationdate =$_SESSION['expiration-date'];
$volumeF = $_SESSION['volumeF'];
?>

<?php if(isset($_POST['valider'])){
    if(empty($errors)){
        $MAx_id_lot= find_max_id('lots','identifiantL');
        $id_lot = 1 + $MAx_id_lot['MaxId'];
        $sql_lot  = "INSERT INTO lots (IdentifiantL ,DatePeremption) VALUES ($id_lot,'{$expirationdate}')";
        if($db->query($sql_lot))
        {
            $MAx_id_tube = find_max_id('tubes','referenceT');
            $MAx_id_lot= find_max_id('lots','identifiantL');
            for ($i=1; $i<=$tubesnumber; $i++) {
                $id_tube=  $i + $MAx_id_tube['MaxId'];
                $v =$volumeF[$i-1];
                $sql_tube  = "INSERT INTO tubes (ReferenceT ,IdentifiantL ,tailleT,EtatTube,IdentifiantA,Volume) VALUES ($id_tube,'{$MAx_id_lot['MaxId']}' , '{$tubesize}' ,'ferme','$IdentifiantA','$v')";
                $db->query($sql_tube) ;
                $sql_fournir = "INSERT INTO fournir (referenceT,identifiantA, identifiantF, quantiteLiv) VALUES ('$id_tube' , '$IdentifiantA','$providername','$v')";
                $db->query($sql_fournir) ;
            }
            $antibody = find_by_id('anticorps', (int)$IdentifiantA, 'IdentifiantA');
            $seuil = $antibody['SeuilAlerte'] ;
            $quantite_stock = find_quantity_stock($IdentifiantA) ;
            $Etat = verification_stock ($seuil ,$quantite_stock[0]['QuantiteStock']);
            update_availibility_stock ($Etat, $IdentifiantA);
            //sucess
            $session->msg('s', "Mise à jour de stock réussi. ");
            redirect('antibodies.php', false);
        }

        else {
            $session->msg("d", "L'ajout de lot a échoué.");
            redirect('recapitulatif.php',false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('recapitulatif.php',false);
    }

} ?>
