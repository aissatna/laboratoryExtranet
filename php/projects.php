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
                    <a href="" class="btn btn-primary">Nouveau projet</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Email responsable</th>
                        <th class="text-center">Date début</th>
                        <th class="text-center">Date fin</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($all_projects as $project): ?>
                        <tr>
                            <td class="text-center">
                                <?php echo first_character($project['nomP'])?>
                            </td>
                            <td class="text-center">
                                <?php echo $project['EmailR']?>
                            </td>
                            <td class="text-center">
                                <?php echo $project['dateDebutP']?>
                            </td>
                            <td class="text-center">
                                <?php echo $project['dateFinP']?>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Remove">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('../layouts/footer.php'); ?>
