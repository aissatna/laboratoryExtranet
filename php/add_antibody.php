<?php
ob_start();
$page_title = 'Ajouter anticorps';
require_once('../includes/load.php');
$all_isotypes = find_all_isotypes();
$all_clones = find_all_clones();
$all_especes = find_all_species();
$all_fluorochromes = find_all_fluorochromes()
?>
<?php include_once('../layouts/header.php'); ?>
<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 container-form">
        <div class="text-center">
            <h3>Ajouter un nouveau anticorps</h3>
        </div>
        <?php echo display_msg($msg); ?>
        <form method="post" action="test_add.php" class="clearfix">
            <small>Les champs avec<span class="required-field">*</span> sont obligatoires .</small>
            <div class="form-group">
                <label for="designation" class="control-label"> Désignation <span class="required-field">*</span>
                </label>
                <input type="text" class="form-control" name="antibody-designation" id="antibody-designation"
                       required>
            </div>
            <div class="form-group">
                <label for="seuil" class="control-label"> Seuil <span class="required-field">*</span> </label>
                <input type="Number" class="form-control" name="antibody-seuil" id="antibody-seuil" min="1" required>
            </div>
            <div class="form-group">
                <label for="volume" class="control-label"> Volume Preconisé <span class="required-field">*</span>
                </label>
                <input type="Number" class="form-control" name="antibody-volume" id="antibody-volume" min="1" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="select_especes">Espèces <span class="required-field">*</span></label>
                    <select id="select_especes" multiple="multiple" name="antibody-especes[]">
                        <?php foreach ($all_especes as $espece): ?>
                            <option value="<?php echo (int)$espece['IdentifiantEsp'];?>"><?php echo $espece['LibelleEsp']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="select_isotypes">Isotypes <span class="required-field">*</span></label>
                    <select id="select_isotypes" multiple="multiple" name="antibody-isotypes[]">
                        <?php foreach ($all_isotypes as $type): ?>
                            <option value="<?php echo (int)$type['IdentifiantType'];?>"><?php echo $type['LibelleType']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="select_clones">Clones <span class="required-field">*</span></label>
                    <select id="select_clones" multiple="multiple" name="antibody-clones[]">
                        <?php foreach ($all_clones as $clone): ?>
                            <option value="<?php echo (int)$clone['IdentifiantC'];?>"><?php echo $clone['LibelleC']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="select_Fluorochromes">Fluorochromes <span class="required-field">*</span></label>
                    <select id="select_Fluorochromes" multiple="multiple" name="antibody-Fluorochromes[]">
                        <?php foreach ($all_fluorochromes as $fluorochrome): ?>
                            <option value="<?php echo (int)$fluorochrome['IdentifiantFluo'];?>"><?php echo $fluorochrome['LibelleFluo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group clearfix">
                <button type="submit" name="add-antibody" class="btn btn-info">Ajouter</button>
            </div>
        </form>
    </div>
    <div class="col-md-3 "></div>
</div>


<?php include_once('../layouts/footer.php'); ?>
