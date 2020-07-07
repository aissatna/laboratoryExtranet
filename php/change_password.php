<?php
$page_title = 'Paramètres compte ';
include_once ('../includes/load.php');
$user = current_user();
?>
<?php
//update user other info
if(isset($_POST['update'])){

    $req_fields = array('new-password','old-password','id' );
    validate_fields($req_fields);

    if(empty($errors)){
        if(($_POST['old-password']) !== $user['MotDePasse'] ){
            $session->msg('d', "Mot de passe non identique ");
            redirect('change_password.php',false);
        }

        $id = (int)$_POST['id'];
        $new = remove_junk($db->escape(($_POST['new-password'])));
        $sql = "UPDATE gestionnaire SET MotDePasse ='{$new}' WHERE IdentifiantG='{$db->escape($id)}'";
        $result = $db->query($sql);
        if($result && $db->affected_rows() === 1):
            $session->logout();
            $session->msg('s',"Mot de passe mit à jour.");
            redirect('../index.php', false);
        else:
            $session->msg('d',' Une erreur est survenue !!');
            redirect('change_password.php', false);
        endif;
    } else {
        $session->msg("d", $errors);
        redirect('change_password.php',false);
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
                    <span> Changer mot de passe </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="change_password.php" class="clearfix">
                    <div class="form-group">
                        <label for="newPassword" class="control-label">Nouveau password </label>
                        <input type="password" class="form-control" name="new-password" placeholder="Nouveau password">
                    </div>
                    <div class="form-group">
                        <label for="oldPassword" class="control-label">Ancien password </label>
                        <input type="password" class="form-control" name="old-password" placeholder="Ancien password">
                    </div>
                    <div class="form-group clearfix">
                        <input type="hidden" name="id" value="<?php echo (int)$user['IdentifiantG'];?>">
                        <button type="submit" name="update" class="btn btn-info">Changer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>

