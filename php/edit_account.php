<?php ob_start();
$page_title = 'Paramètres compte ';
include_once ('../includes/load.php');
$user = current_user();
?>
<?php
//update user other info
if(isset($_POST['update'])){
    $req_fields = array('name','username' );
    validate_fields($req_fields);
    if(empty($errors)){
        $id = (int)$user['IdentifiantG'];
        $name = remove_junk($db->escape($_POST['name']));
        $username = remove_junk($db->escape($_POST['username']));
        $sql = "UPDATE gestionnaire SET Nom ='{$name}', Login ='{$username}' WHERE  IdentifiantG='{$id}'";
        $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
            $session->msg('s',"Compte mis à jour ");
            redirect('edit_account.php', false);
        } else {
            $session->msg('d','Une erreur est survenue !!');
            redirect('edit_account.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_account.php',false);
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
                    <span> Éditer Compte </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_account.php?id=<?php echo (int)$user['IdentifiantG'];?>" class="clearfix">
                    <div class="form-group">
                        <label for="name" class="control-label">Nom</label>
                        <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($user['Nom'])); ?>">
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['Login'])); ?>">
                    </div>
                    <div class="form-group clearfix">
                        <a href="change_password.php" title="change password" class="btn btn-danger pull-right">Change Password</a>
                        <button type="submit" name="update" class="btn btn-info">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>

