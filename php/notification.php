<?php ob_start();
$page_title = 'Anticorps';
require_once('../includes/load.php');
// Find all antibodies where status is different then 'Bon'
$all_antibodies = find_antibody_with_status();
?>
<?php foreach ($all_antibodies as $antibody): ?>
<?php if($antibody['EtatStockA'] ==='Rupture'): ?>
<div class="card text-white  bg-danger text-center">
    <div class="card-header"><?php echo $antibody['DesignationA']?></div>
    <div class="card-body">
        <h5 class="card-title"> <strong><?php echo $antibody['EtatStockA']?></strong></h5>
        <p class="card-text">L'anticorps  <?php echo $antibody['DesignationA']?> est en repture de stock.</p>
    </div>
</div>
    <?php elseif ($antibody['EtatStockA'] ==='Risque'): ?>
        <div class="card text-white  bg-warning  text-center">
            <div class="card-header"><?php echo $antibody['DesignationA']?></div>
            <div class="card-body">
                <h5 class="card-title"> <strong><?php echo $antibody['EtatStockA']?></strong></h5>
                <p class="card-text">L'anticorps  <?php echo $antibody['DesignationA']?> est en risque de rupture de stock.</p>
            </div>
        </div>

    <?php elseif ($antibody['EtatStockA'] ==='Signaler'): ?>
    <?php $antibody_warning=find_by_id('signaler',$antibody['IdentifiantA'],'IdentifiantA') ?>

        <div class="card text-white  bg-info text-center">
            <div class="card-header"><?php echo $antibody['DesignationA']?></div>
            <div class="card-body">
                <h5 class="card-title"> <strong><?php echo $antibody['EtatStockA']?></strong></h5>
                <p class="card-text">L'anticorps  <?php echo $antibody['DesignationA']?> est signalé pour le projet :
                    <?php $project_warning_antibody=find_project_warning_antibody($antibody['IdentifiantA']);?>
                    <?php echo $project_warning_antibody['IdentifiantA']?><br>
                    <strong>Message :</strong>   <?php echo $project_warning_antibody['IdentifiantA']?><br>


                    .</p>
            </div>
        </div>
    <?php endif; ?>

<?php endforeach;?>
