<?php
ob_start();
$page_title = 'Ajouter anticorps';
require_once('../includes/load.php');
// Get information from database
$all_isotypes = find_all_isotypes();
$all_clones = find_all_clones();
$all_especes = find_all_species();
$all_fluorochromes = find_all_fluorochromes()
?>
<?php
if (isset($_POST['add-antibody'])) {
    
    $req_fields = array('antibody-designation', 'antibody-seuil', 'antibody-volume');
    validate_fields($req_fields);
    $a_name = remove_junk($db->escape($_POST['antibody-designation']));
    $a_seuil = remove_junk($db->escape($_POST['antibody-seuil']));
    $a_volume = remove_junk($db->escape($_POST['antibody-volume']));
    $verif_name = find_by_field('anticorps', $a_name ,'DesignationA');
    if (empty($verif_name)) {
        if (empty($errors)) {

            $query = "INSERT INTO anticorps (DesignationA,SeuilAlerte,EtatStockA, VolumePreconise)
                    VALUES ('{$a_name}','{$a_seuil}','Rupture','{$a_volume}')";
            if ($db->query($query)) {
                $id_insert = $db->insert_id();
                foreach ($_POST['antibody-clones'] as $clone){
                    $query_clone =" insert into cloneanticorps (IdentifiantA,IdentifiantC)values ('{$id_insert}','$clone')" ;
                    $resultatclone =$db->query($query_clone); }
                foreach ($_POST['antibody-isotypes'] as $isotype){
                    $query_isotype =" insert into typeanticorps (IdentifiantA,IdentifiantType)values ('{$id_insert}','$isotype')" ;
                    $resultatIsotype =$db->query($query_isotype); }
                foreach ($_POST['antibody-especes'] as $espece){
                    $query_espece =" insert into especeanticorps (IdentifiantA,IdentifiantEsp)values ('{$id_insert}','$espece')" ;
                    $resultatespece =$db->query($query_espece); }
                foreach ($_POST['antibody-Fluorochromes'] as $fluo){
                    $query_fluo =" insert into fluorochromeanticorps (IdentifiantA,Identifiantfluo)values ('{$id_insert}','$fluo')" ;
                    $resultatfluo =$db->query($query_fluo); }


                if ($resultatclone and $resultatIsotype and $resultatespece  and $resultatfluo) {
                    //sucess
                    $session->msg('s', "Anticorps ajouté. ");
                    redirect('add_antibody.php', false);
                } else {
                    //failed
                    delete_by_id('anticorps',$id_insert, 'IdentifiantA');
                    $session->msg('d', "L'ajout a échoué.");
                    redirect('add_antibody.php', false);}
            }
        } else {
            $session->msg("d", $errors);
            redirect('add_antibody.php', false);}
    } else {
        $session->msg("d", " Cet anticorps  existe déja , entrer un autre .");
        redirect('antibodies.php', false);}
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
                    <span>nouveau anticorps </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="add_antibody.php" class="clearfix">
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
                        <label for="volume" class="control-label"> Volume Preconisé (μL)<span class="required-field">*</span>
                        </label>
                        <input type="Number" class="form-control" name="antibody-volume" id="antibody-volume" min="1" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 ">
                            <label for="select_especes">Espèces <span class="required-field">*</span></label>
                            <select id="select_especes" multiple="multiple" name="antibody-especes[]"  required >
                                <?php foreach ($all_especes as $espece): ?>
                                    <option value="<?php echo (int)$espece['IdentifiantEsp'];?>"><?php echo $espece['LibelleEsp']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="select_isotypes">Isotypes <span class="required-field">*</span></label>
                            <select id="select_isotypes" multiple="multiple" name="antibody-isotypes[]" required >
                                <?php foreach ($all_isotypes as $type): ?>
                                    <option value="<?php echo (int)$type['IdentifiantType'];?>"><?php echo $type['LibelleType']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="select_clones">Clones <span class="required-field">*</span></label>
                            <select id="select_clones" multiple="multiple" name="antibody-clones[]" required >
                                <?php foreach ($all_clones as $clone): ?>
                                    <option value="<?php echo (int)$clone['IdentifiantC'];?>"><?php echo $clone['LibelleC']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="select_Fluorochromes">Fluorochromes <span class="required-field">*</span></label>
                            <select id="select_Fluorochromes" multiple="multiple" name="antibody-Fluorochromes[]" required >
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
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

<?php include_once('../layouts/footer.php'); ?>
