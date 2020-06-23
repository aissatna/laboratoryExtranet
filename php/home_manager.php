<?php ob_start();
$page_title = 'Accueil';
include_once("../includes/load.php");
include_once('../layouts/header.php'); ?>
    <div class="row">
        <div class="col-md-12 ">
            <?php echo display_msg($msg); ?>
        </div>
        <div class="col-md-12">
            <div class="panel">
                <div class="jumbotron text-center">
                    <h1>Welcome!</h1>
                </div>
            </div>
        </div>
    </div>
<?php include_once('../layouts/footer.php'); ?>