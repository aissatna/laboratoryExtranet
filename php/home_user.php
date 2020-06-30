<?php ob_start();
$page_title = 'Accueil';
include_once("../includes/load.php");
$all_teams = find_all_teams();
$all_projects = find_all_projects();
?>
<?php include_once('../layouts/header.php'); ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel">
                <div class="jumbotron">
                    <form method="post" action="antibodies_user.php">
                        <div class="form-group">
                            <label for="team-name"> Nom de l'équipe<span class="required-field">*</span> </label>
                            <select class="form-control" name="team-id" id="team-name" required>
                                <?php foreach ($all_teams as $team): ?>
                                    <option value="<?php echo (int)$team['IdentifiantE']; ?>"><?php echo first_character($team['NomE']) ; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="project-name">Nom de projet<span class="required-field">*</span> </label>
                            <select class="form-control" name="project-id" id="project-name" required>
                                <?php foreach ($all_projects as $project): ?>
                                    <option value="<?php echo (int)$project['IdentifiantP']; ?>"><?php echo first_character($project['NomP']) ; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" name="next" class="btn btn-info">Suivant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
<?php include_once('../layouts/footer.php'); ?><?php
