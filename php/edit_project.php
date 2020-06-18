<?php ob_start();
$page_title = 'Editer projet';
require_once('../includes/load.php');
$e_project = find_by_id('projets',(int)$_GET['id'],'IdentifiantP');
if(!$e_project){
    $session->msg("d","projet non trouvé .");
    redirect('projects.php');
}

?>
<?php
if(isset($_POST['update'])){
    if(empty($errors)){
        $p_emailR = (empty($_POST['project-chef-email'])) ?
            '' : remove_junk($db->escape($_POST['project-chef-email']));
        $p_ending_date = (empty($_POST['ending-date'])) ?
            '' : remove_junk($db->escape($_POST['ending-date']));
        $query   = "UPDATE projets SET";
        $query  .=" EmailR ='{$p_emailR}', DateFinP ='{$p_ending_date}'";
        $query  .=" WHERE IdentifiantP ='{$e_project['IdentifiantP']}'";
        $result = $db->query($query);
        if($result && $db->affected_rows() === 1){
            $session->msg('s',"Modification réussie");
            redirect('projects.php', false);
        } else {
            $session->msg('d',' La modification a échoué!');
            redirect('edit_project.php?IdentifiantP='.$e_project['IdentifiantP'], false);
        }
    }
    else{
        $session->msg("d", $errors);
        redirect('edit_product.php?IdentifiantP='.$e_project['IdentifiantP'], false);
    }
}
?>
<?php include_once('../layouts/header.php'); ?>
    <div class="add-project-page">
        <div class="text-center">
            <h3>Modfication</h3>
        </div>
        <?php echo display_msg($msg); ?>
        <form method="post" action="edit_project.php?id=<?php echo (int)$e_project['IdentifiantP'];?>" class="clearfix">
            <div class="form-group">
                <label for="level" class="control-label">Email responsable</label>
                <input type="email" class="form-control" name="project-chef-email">
            </div>
            <div class="form-group">
                <label for="ending-date" class="control-label">Date de fin </label>
                <input type="date" class="form-control" name="ending-date" id="ending-date">
            </div>

            <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Modifier</button>
            </div>
        </form>
    </div>

<?php include_once('../layouts/footer.php'); ?>