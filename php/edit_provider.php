<?php ob_start();
$page_title = 'Editer fournisseur';
require_once('../includes/load.php');
$e_provider = find_by_id('fournisseurs',(int)$_GET['id'],'IdentifiantF');
if(!$e_provider){
    $session->msg("d","fournisseur non trouvé .");
    redirect('providers.php');
}

?>
<?php
if(isset($_POST['update'])){
    if(empty($errors)){
        $p_phone = (empty($_POST['provider-phone'])) ?
            '' : remove_junk($db->escape($_POST['provider-phone']));
        $p_listprices = (empty($_POST['provider-listprices'])) ?
            '' : remove_junk($db->escape($_POST['provider-listprices']));
      
        $query   = "UPDATE fournisseurs SET";
        $query  .=" TelephoneF ='{$p_phone}',ListeDesPrix ='{$p_listprices}'";
        $query  .=" WHERE IdentifiantF ='{$e_provider['IdentifiantF']}'";
        $result = $db->query($query);
        if($result && $db->affected_rows() === 1){
            $session->msg('s',"Modification réussie");
            redirect('providers.php', false);
        } else {
            $session->msg('d',' La modification a échoué!');
            redirect('edit_provider.php?IdentifiantF='.$e_provider['IdentifiantF'], false);
        }
    }
    else{
        $session->msg("d", $errors);
        redirect('edit_provider.php?IdentifiantF='.$e_provider['IdentifiantF'], false);
    }
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
                    <span> Éditer fournisseur </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_provider.php?id=<?php echo (int)$e_provider['IdentifiantF'];?>" class="clearfix">
                    <div class="form-group">
                        <label for="phone" class="control-label"> Téléphone </label>
                        <input type="tel" class="form-control" name="provider-phone" id="provider-phone"  pattern="[0-9]{10}" >
                    </div>
                    <div class="form-group">
                        <label for="listprices" class="control-label"> Liste des prix </label>
                        <input type="file" class="form-control-file" name="provider-listprices" id="provider-listprices"  >
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" name="update" class="btn btn-info">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>
