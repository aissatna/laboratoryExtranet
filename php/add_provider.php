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
    $req_fields = array('provider-name','provider-email','provider-siteweb');
    validate_fields($req_fields);
    $file = find_by_field('fournisseurs',$fileName,'ListeDesPrix');
    if (empty($file))
    {
        if(empty($errors)){
            $p_name = remove_junk($db->escape($_POST['provider-name']));
            $p_email = remove_junk($db->escape($_POST['provider-email']));

            $p_phone = (empty($_POST['provider-phone'])) ?
                '' : remove_junk($db->escape($_POST['provider-phone']));
            $p_siteweb = (empty($_POST['provider-siteweb'])) ?
                '' : remove_junk($db->escape($_POST['provider-siteweb']));
            $p_listprices = (empty($_POST['provider-listprices'])) ?
                '' : remove_junk($db->escape($_POST['provider-listprices']));

            $query  = "INSERT INTO fournisseurs (RaisonSocialeF,EmailF,TelephoneF,SiteWebF,ListeDesPrix) VALUES (
            '{$p_name}','{$p_email}','{$p_phone}','{$p_siteweb}','{$fileName}')";
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
                    <span>nouveau fournisseur </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="add_provider.php" enctype="multipart/form-data" class="clearfix">
                    <small>Les champs avec<span class="required-field">*</span> sont obligatoires .</small>
                    <div class="form-group">
                        <label for="provider-name" class="control-label"> Raison sociale <span class="required-field">*</span> </label>
                        <input type="text" class="form-control" name="provider-name" id="provider-name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email <span class="required-field">*</span></label>
                        <input type="email" class="form-control" name="provider-email" id="provider-email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label"> Téléphone </label>
                        <input type="text" class="form-control" name="provider-phone" id="provider-phone"  pattern="[0-9]{10}" >
                    </div>
                    <div class="form-group">
                        <label for="siteweb" class="control-label">Site Web<span class="required-field">*</span></label>
                        <input type="url" class="form-control" name="provider-siteweb" id="provider-siteweb"
                               placeholder="https://example.com">
                    </div>
                    <div class="form-group">
                        <label for="listprices" class="control-label"> Liste des prix </label>
                        <input type="file" class="form-control-file" name="provider-listprices" id="provider-listprices"  >
                    </div>

                    <div class="form-group clearfix">
                        <button type="submit" name="add-provider" class="btn btn-info">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>
