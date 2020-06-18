<?php
ob_start();
$page_title = 'Editer Stock';
require_once('../includes/load.php');
$MAx_id = find_max_id('tubes','referenceT');
// Récupération de données en session
$IdentifiantA=$_SESSION["IdentifiantA"] ;
//mettre en session les données necessaire pour la page suivante
$_SESSION ["provider-name"]= $_POST['provider-name'];
$providername = $_POST['provider-name'];

$_SESSION ["tubes-number"]= $_POST['tubes-number'];
$tubesnumber= $_POST['tubes-number'];

$_SESSION ["tube_size"]= $_POST['tube_size'];
$tubesize = $_POST['tube_size'];

$_SESSION ["expiration-date"]= $_POST['expiration-date'];
$expirationdate = $_POST['expiration-date'];

?>
<?php

if(isset($_POST['edit-stock'])){
    $req_fields = array('provider-name','tubes-number','tube_size','expiration-date');
    validate_fields($req_fields);

    if( !empty($errors)){
      $session->msg("d", $errors);
      redirect('edit_stock.php',false);
    }
}
?>
<?php include_once('../layouts/header.php'); ?>
<div class="add-project-page">
    <div class="row">
        <div class="col-md-12">
            <?php echo display_msg($msg); ?>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Informations tubes </span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="recapitulatif.php" class="clearfix">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Réference</th>
                                <th class="text-center">Volume fourni <span class="required-field">*</span> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  for ($i=1; $i<=$tubesnumber; $i++){?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $i+$MAx_id['MaxId'] ;?>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" class="form-control" name="volumeF[]" id="volumeF" required  min ='1' >
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="form-group clearfix">
                            <button type="submit" name="edit-stock2" class="btn btn-info">Suivant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once('../layouts/footer.php'); ?>
