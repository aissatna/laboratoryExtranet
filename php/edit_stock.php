<?php
ob_start();
$page_title = 'Editer stock';
require_once('../includes/load.php');
$all_providers = find_all_providers();
$_SESSION ["IdentifiantA"]= $_GET['IdentifiantA'];
?>
<?php include_once('../layouts/header.php'); ?>
    <div class="add-project-page">
        <div class="text-center">
        <h3> <?php  $antibody = find_by_id('anticorps',(int)$_GET['IdentifiantA'],'IdentifiantA');  echo 'Anticorps  '.$antibody['DesignationA'].' ';?></h3>
        </div>
        <?php echo display_msg($msg); ?>
        <form method="post" action="edit_stock2.php" class="clearfix">
            <small>Les champs avec<span class="required-field">*</span> sont obligatoires .</small>
            <div class="form-group">
                <label for="provider-name">Fournisseur <span class="required-field">*</span> </label>
                <select class="form-control" name="provider-name" id="provider-name" required>
                <?php foreach ($all_providers as $provider):?>
                    <option value="<?php echo (int)$provider['IdentifiantF'];?>"><?php echo $provider['NomF']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tubes-number" class="control-label">Nombre de tubes récu <span class="required-field" >*</span>  </label>
                <input type="number" class="form-control" name="tubes-number" min="1" required>
            </div>

            <div class="form-group">
                <label for="tube_size" class="control-label">Taille tube <span class="required-field" >*</span></label>
                <input type="number" class="form-control" name="tube_size" id="tube_size" number="1" required>
            </div>
            <div class="form-group">
                <label for="expiration-date" class="control-label">Date de péremption <span class="required-field" >*</span>  </label>
                <input type="date" class="form-control" name="expiration-date" id="expiration-date" required>
            </div>

            <div class="form-group clearfix">
                <button type="submit" name="edit-stock" class="btn btn-info">Suivant</button>
            </div>
        </form>
    </div>

<?php include_once('../layouts/footer.php'); ?>
