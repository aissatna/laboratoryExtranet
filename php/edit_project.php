<?php ob_start();
$page_title = 'Editer projet';
require_once('../includes/load.php');
$e_project = find_by_id('projets', (int)$_GET['id'], 'IdentifiantP');
if (!$e_project) {
    $session->msg("d", "Pas de modification .");
    redirect('projects.php');
}
?>
<?php
if (isset($_POST['update'])) {
    if (empty($errors)) {
        $p_emailR = (empty($_POST['project-chef-email'])) ?
            '' : remove_junk($db->escape($_POST['project-chef-email']));
        $p_ending_date = (empty($_POST['ending-date'])) ?
            '' : remove_junk($db->escape($_POST['ending-date']));
        if ($p_emailR <> ""  ){
            $query = "UPDATE projets SET";
            $query .= " EmailR ='{$p_emailR}'";
            $query .= " WHERE IdentifiantP ='{$e_project['IdentifiantP']}'";
            $result = $db->query($query);}
        if ($p_ending_date <> ""  ){
            $starting_date = $e_project['DateDebutP'] ;
            if ($starting_date > $p_ending_date){
                $session->msg("d", ' La Date de début est supérieure à la date fin. ');
                redirect('edit_project.php?id='.(int)$e_project['IdentifiantP'],false);
            }
            else {
                $query = "UPDATE projets SET";
                $query .= " DateFinP ='{$p_ending_date}'";
                $query .= " WHERE IdentifiantP ='{$e_project['IdentifiantP']}'";
                $result = $db->query($query);}
        }
        if ($result && $db->affected_rows() === 1) {
            $session->msg('s', "Modification réussie");
            redirect('projects.php', false);
        } else {
            $session->msg('d', ' La modification a échoué!');
            redirect('edit_project.php?IdentifiantP=' . $e_project['IdentifiantP'], false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_project.php?IdentifiantP=' . $e_project['IdentifiantP'], false);
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
                    <span> Éditer projet </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_project.php?id=<?php echo (int)$e_project['IdentifiantP']; ?>"
                      class="clearfix">
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
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>
