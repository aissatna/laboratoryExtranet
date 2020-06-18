<?php ob_start();
$page_title = 'Projets';
require_once('../includes/load.php');
$all_projects = find_all_projects();
?>
<?php include_once('../layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Projets</span>
                </strong>
                <div class="pull-right">
                    <a href="add_project.php" class="btn btn-primary">Nouveau projet</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover" id="JS-data-table-projects">
                    <thead>
                    <tr>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Email responsable</th>
                        <th class="text-center">Date début</th>
                        <th class="text-center">Date fin</th>
                        <th class="text-center">Equipe</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($all_projects as $project): ?>
                        <tr>
                            <td class="text-center">
                                <?php echo first_character($project['NomP'])?>
                            </td>
                            <td class="text-center">
                                <?php echo $project['EmailR']?>
                            </td>
                            <td class="text-center">
                                <?php echo $project['DateDebutP']?>
                            </td>
                            <td class="text-center">
                                <?php echo $project['DateFinP']?>
                            </td>
                            <td class="text-center">
                                <?php echo $project['NomE']?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-xs btn-danger" title="Remove"
                                       data-href="delete_project.php?IdentifiantP=
                                       <?php echo (int)$project['IdentifiantP'];?>" data-toggle="modal"
                                       data-target="#confirm-delete"><i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                    <a href="edit_project.php?id=<?php echo (int)$project['IdentifiantP'];?>"
                                       class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--*******************Modal*************************-->
<!--<div class="modal fade " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>

            <div class="modal-body">
                <p>Voulez vous vraiment supprimer ce contenu ?.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                <a class="btn btn-danger btn-ok">Oui</a>
            </div>
        </div>
    </div>
</div>-->
<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>
