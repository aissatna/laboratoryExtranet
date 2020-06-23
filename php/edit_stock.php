<?php
ob_start();
$page_title = 'Editer stock';
require_once('../includes/load.php');
$all_providers = find_all_providers();
//$_SESSION ["IdentifiantA"] = $_GET['IdentifiantA'];
$e_antibody = find_by_id('anticorps', (int)$_GET['IdentifiantA'], 'IdentifiantA');
if (!$e_antibody) {
    $session->msg("d", "anticorps non trouvé .");
    redirect('antibodies.php');
}
?>
<?php
if (isset($_POST['edit-stock'])) {
    $req_fields = array('provider-name', 'tubes-number', 'tube_size', 'expiration-date');
    validate_fields($req_fields);
    if (empty($errors)) {
        $expiration_date=strtotime($_POST['expiration-date']);
        $current_date=strtotime(date("Y-m-d"));
        if ($expiration_date < $current_date) {
            $session->msg("d", 'Date expiration a depasée la date du jour');
            redirect('edit_stock.php?IdentifiantA='.(int)$e_antibody['IdentifiantA'], false);


        } else
        {  $_SESSION["IdentifiantA"]=$_GET['IdentifiantA'];
            $_SESSION ["provider-name"] = $_POST['provider-name'];
            $_SESSION ["tubes-number"] = $_POST['tubes-number'];
            $_SESSION ["tube_size"] = $_POST['tube_size'];
            $_SESSION ["expiration-date"] = $_POST['expiration-date'];
            redirect('edit_stock2.php?IdentifiantA='.(int)$e_antibody['IdentifiantA'], false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('edit_stock.php?IdentifiantA='.(int)$e_antibody['IdentifiantA'], false);
    }
}
?>

<?php include_once('../layouts/header.php'); ?>
<div class="add-project-page">
    <div class="text-center">
        <h3> <?php $antibody = find_by_id('anticorps', (int)$_GET['IdentifiantA'], 'IdentifiantA');
            echo 'Anticorps  ' . $antibody['DesignationA'] . ' '; ?></h3>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="edit_stock.php?IdentifiantA=<?php echo (int)$e_antibody['IdentifiantA'];?>" class="clearfix">
        <small>Les champs avec<span class="required-field">*</span> sont obligatoires .</small>
        <div class="form-group">
            <label for="provider-name">Fournisseur <span class="required-field">*</span> </label>
            <select class="form-control" name="provider-name" id="provider-name" required>
                <?php foreach ($all_providers as $provider): ?>
                    <option value="<?php echo (int)$provider['IdentifiantF']; ?>"><?php echo $provider['RaisonSocialeF']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tubes-number" class="control-label">Nombre de tubes récu <span class="required-field">*</span>
            </label>
            <input type="number" class="form-control" name="tubes-number" min="1" required>
        </div>

        <div class="form-group">
            <label for="tube_size" class="control-label">Taille tube <span class="required-field">*</span></label>
            <input type="number" class="form-control" name="tube_size" id="tube_size" min="1" required>
        </div>
        <div class="form-group">
            <label for="expiration-date" class="control-label">Date de péremption <span class="required-field">*</span>
            </label>
            <input type="date" class="form-control" name="expiration-date" id="expiration-date" required>
        </div>

        <div class="form-group clearfix">
            <button type="submit" name="edit-stock" class="btn btn-info" >Suivant</button>
        </div>
    </form>
</div>

<?php include_once('../layouts/footer.php'); ?>
