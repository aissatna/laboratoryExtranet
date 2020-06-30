<?php
require_once('../includes/load.php');
if ($_POST['antibodyID']) {
    $antibodyID = $_POST['antibodyID']; //escape string
    //echo $antibodyID;
} else {
    echo 'error';
}
$types_antibody = find_Types_of_antibody($antibodyID);
$clones_antibody = find_clones_of_antibody($antibodyID);
$species_antibody = find_species_of_antibody($antibodyID);
$fluorochromes_antibody = find_fluorochromes_of_antibody($antibodyID);
?>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Espèces
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($species_antibody as $species): ?>
                    <li class="list-group-item"> <?php echo first_character($species['LibelleEsp']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Isotypes
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($types_antibody as $types): ?>
                    <li class="list-group-item"> <?php echo first_character($types['LibelleType']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Clones
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($clones_antibody as $clone): ?>
                    <li class="list-group-item"> <?php echo first_character($clone['LibelleC']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Fluorochromes
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($fluorochromes_antibody as $fluorochromes): ?>
                    <li class="list-group-item"> <?php echo first_character($fluorochromes['LibelleFluo']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
