<?php
ob_start();
$page_title = 'Ajouter projet';
require_once('../includes/load.php');
$all_teams = find_all_teams();
?>
<?php
if (isset($_POST['add-project'])) {
    $req_fields = array('project-name', 'team-project', 'starting-date');
    validate_fields($req_fields);

    /* if(find_by_groupName($_POST['group-name']) === false ){
         $session->msg('d','<b>Sorry!</b> Entered Group Name already in database!');
         redirect('add_group.php', false);
     }elseif(find_by_groupLevel($_POST['group-level']) === false) {
         $session->msg('d','<b>Sorry!</b> Entered Group Level already in database!');
         redirect('add_group.php', false);
     }*/
    if (empty($errors)) {
        $p_name = remove_junk($db->escape($_POST['project-name']));
        $p_team = remove_junk($db->escape($_POST['team-project']));
        $p_starting_date = remove_junk($db->escape($_POST['starting-date']));
        $p_chef_email = (empty($_POST['project-chef-email'])) ?
            '' : remove_junk($db->escape($_POST['project-chef-email']));
        $p_ending_date = (empty($_POST['ending-date'])) ?
            '' : remove_junk($db->escape($_POST['ending-date']));
        $query_1 = "INSERT INTO projets (NomP, EmailR, DateDebutP, DateFinP) 
                    VALUES ('{$p_name}','{$p_chef_email}','{$p_starting_date}','{$p_ending_date}')";
        if ($db->query($query_1)) {
            $id_insert = $db->insert_id();
            $query_2 = "INSERT INTO travailler (IdentifiantE, IdentifiantP) VALUES ('{$p_team}','{$id_insert}')";
            if ($db->query($query_2)) {
                //sucess
                $session->msg('s', "Projet ajouté. ");
                redirect('add_project.php', false);
            } else {
                //failed
                delete_by_id('projets', $id_insert, 'IdentifiantP');
                $session->msg('d', "L'ajout a échoué.");
                redirect('add_project.php', false);
            }
        }

    } else {
        $session->msg("d", $errors);
        redirect('add_project.php', false);
    }
}
?>
<?php include_once('../layouts/header.php'); ?>
    <div class="add-project-page">
        <div class="text-center">
            <h3>Ajouter un nouveau projet</h3>
        </div>
        <?php echo display_msg($msg); ?>
        <form method="post" action="add_project.php" class="clearfix">
            <small>Les champs avec<span class="required-field">*</span> sont obligatoires .</small>
            <div class="form-group">
                <label for="name" class="control-label"> Nom de projet<span class="required-field">*</span> </label>
                <input type="text" class="form-control" name="project-name" id="project-name" required>
            </div>
            <div class="form-group">
                <label for="level" class="control-label">Email responsable</label>
                <input type="email" class="form-control" name="project-chef-email">
            </div>
            <div class="form-group">
                <label for="team-project">Equipe de projet<span class="required-field">*</span> </label>
                <select class="form-control" name="team-project" id="team-project" required>
                    <?php foreach ($all_teams as $team): ?>
                        <option value="<?php echo (int)$team['IdentifiantE']; ?>"><?php echo $team['NomE']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="starting_date" class="control-label">Date de début<span
                            class="required-field">*</span></label>
                <input type="date" class="form-control" name="starting-date" id="starting_date">
            </div>
            <div class="form-group">
                <label for="ending-date" class="control-label">Date de fin </label>
                <input type="date" class="form-control" name="ending-date" id="ending-date">
            </div>

            <div class="form-group clearfix">
                <button type="submit" name="add-project" class="btn btn-info">Ajouter</button>
            </div>
        </form>
    </div>

<?php include_once('../layouts/footer.php'); ?>