<?php
ob_start();
$page_title = 'Ajouter fournisseur';
require_once('../includes/load.php');
?>
<?php
if(isset($_POST['add-provider'])){
    $fileName =$_FILES['provider-listprices']['name'];
    $fileTemp =$_FILES['provider-listprices']['tmp_name'];
    if (is_uploaded_file ($fileTemp)){
        if (move_uploaded_file($fileTemp,"../uploads/$fileName")){
            echo 'file uploaded successful';}
        else {
            echo 'file uploaded failed ';
        }


    } else{
        echo 'no file is selected ';
    }
    $req_fields = array('provider-lastname','provider-firstname','provider-email');
    validate_fields($req_fields);
    $file = find_by_field('fournisseurs',$fileName,'ListeDesPrix');
    if (empty($file) or $fileName ==="")
    {
        if(empty($errors)){
            $p_lastname = remove_junk($db->escape($_POST['provider-lastname']));
            $p_firstname = remove_junk($db->escape($_POST['provider-firstname']));
            $p_email = remove_junk($db->escape($_POST['provider-email']));

            $p_phone = (empty($_POST['provider-phone'])) ?
                '' : remove_junk($db->escape($_POST['provider-phone']));
            $p_siteweb = (empty($_POST['provider-siteweb'])) ?
                '' : remove_junk($db->escape($_POST['provider-siteweb']));
            $p_listprices = (empty($_POST['provider-listprices'])) ?
                '' : remove_junk($db->escape($_POST['provider-listprices']));

            $query  = "INSERT INTO fournisseurs (";
            $query .="NomF,PrenomF,EmailF,TelephoneF,SiteWebF,ListeDesPrix";
            $query .=") VALUES (";
            $query .=" '{$p_lastname}','{$p_firstname}','{$p_email}','{$p_phone}','{$p_siteweb}','{$fileName}'";
            $query .=")";
            if($db->query($query)){
                //sucess
                $session->msg('s', "Fournisseur ajouté. ");
                redirect('add_provider.php', false);}
            else{
                //failed
                $session->msg('d', "L'ajout a échoué.");
                redirect('add_provider.php', false);
            }
        }
        else {
            $session->msg("d", $errors);
            redirect('add_provider.php',false);
        }
    }
    else {$session->msg("d", "le nom de fichier  existe déja.");
        redirect('add_provider.php',false); }
}
?>
<?php include_once('../layouts/header.php'); ?>
<div class="add-project-page">
    <div class="text-center">
        <h3>Ajouter un nouveau fournisseur</h3>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="add_provider.php" enctype="multipart/form-data" class="clearfix">
        <small>Les champs avec<span class="required-field">*</span> sont obligatoires .</small>
        <div class="form-group">
            <label for="lastname" class="control-label"> Nom <span class="required-field">*</span> </label>
            <input type="text" class="form-control" name="provider-lastname" id="provider-lastname" required>
        </div>
        <div class="form-group">
            <label for="firstname" class="control-label"> Prénom <span class="required-field">*</span> </label>
            <input type="text" class="form-control" name="provider-firstname" id="provider-firstname" required>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email <span class="required-field">*</span></label>
            <input type="email" class="form-control" name="provider-email" id="provider-email" required>
        </div>
        <div class="form-group">
            <label for="phone" class="control-label"> Télephone </label>
            <input type="text" class="form-control" name="provider-phone" id="provider-phone"  pattern="[0-9]{10}" >
        </div>
        <div class="form-group">
            <label for="siteweb" class="control-label"> Site Web </label>
            <input type="url" class="form-control" name="provider-siteweb" id="provider-siteweb"
                    placeholder="https://example.com">
        </div>
        <div class="form-group">
            <label for="listprices" class="control-label"> Liste des prix </label>
            <input type="file" class="form-control" name="provider-listprices" id="provider-listprices"  >
        </div>

        <div class="form-group clearfix">
            <button type="submit" name="add-provider" class="btn btn-info">Ajouter</button>
        </div>
    </form>
</div>

<?php include_once('../layouts/footer.php'); ?>
