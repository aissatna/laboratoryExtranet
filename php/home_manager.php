<?php ob_start();
$page_title = 'Accueil';
include_once("../includes/load.php");
include_once('../layouts/header.php'); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3"></div>
        <div class="col-xs-12 col-sm-4 col-md-6 text-center">
            <?php echo display_msg($msg); ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3"></div>
        <div class="col-xs-12 col-sm-4 col-md-6">
            <div class="panel">
                <div class="jumbotron text-center">
                    <h1>Welcome!</h1>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3"></div>
    </div>
<?php include_once('../layouts/footer.php'); ?>