<?php ob_start();
$page_title = 'Projets';
require_once('../includes/load.php');
$all_projects = find_all_projects();
?>
<?php include_once('../layouts/header.php'); ?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center">
        <h4>
            <?php echo display_msg($msg); ?>
        </h4>
    </div>
    <div class="col-md-4"></div>
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
                        <?php foreach ($all_projects as $project): ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo first_character($project['NomP']) ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $project['EmailR'] ?>
                                </td>
                                <td class="text-center">
                                    <?php echo(date("d-m-Y", strtotime($project['DateDebutP']))); ?>
                                </td>
                                <td class="text-center">
                                    <?php if (($project['DateFinP']) === '0000-00-00') '';
                                    else echo(date("d-m-Y", strtotime($project['DateFinP']))); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $project['NomE'] ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-xs btn-danger" title="Remove"
                                           data-href="delete_project.php?IdentifiantP=
                                       <?php echo (int)$project['IdentifiantP']; ?>" data-toggle="modal"
                                           data-target="#delete-modal"><i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                        <a href="edit_project.php?id=<?php echo (int)$project['IdentifiantP']; ?>"
                                           class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../layouts/delete-modal.php'); ?>
<?php include_once('../layouts/footer.php'); ?>
