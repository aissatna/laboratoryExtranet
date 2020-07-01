<?php
ob_start();
$page_title = 'Prélèvement';
require_once('../includes/load.php');
?>
<?php include_once('../layouts/header.php'); ?>
<?php
    if (isset($_POST["data_antibodies"])) {
        $query  = explode('&', $_POST['data_antibodies']);
        $params = array();
        foreach( $query as $param )
        {// prevent notice on explode() if $param has no '='
            if (strpos($param, '=') === false) $param += '=';
            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }
        $antibodyIDs = array_unique($params['antibody']);
        $_SESSION['$antibodyIDs']=$antibodyIDs;
    } else {
        $session->msg("d", "Il manque des renseignements");
        redirect('antibodies_user.php', false);
    }
?>
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
                    <span>Informations prélèvement </span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="recap_preleve_antibody.php" class="clearfix">
                    <small>Les quantités insérées ne doivent pas dépasser les quantités en stock </small>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Anticorps</th>
                            <th class="text-center">Quantité stockée (μL)</th>
                            <th class="text-center">Quantité a prélevé  (μL)<span class="required-field">*</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($antibodyIDs as $antibodyID):?>
                        <?php $antibody = find_by_id('anticorps', $antibodyID, 'IdentifiantA');?>
                        <tr>
                            <td class="text-center">
                                <?php echo $antibody['DesignationA']?>
                            </td>
                            <td class="text-center">
                                <?php $quantity_stock=find_quantity_stock($antibodyID)?>
                                <?php echo $quantity_stock[0]['QuantiteStock']?>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="quantitesP[]" required
                                       min='1' max="<?php echo $quantity_stock[0]['QuantiteStock'] ?>">
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <div class="form-group clearfix">
                        <button type="submit" name="preleve" class="btn btn-info">Prélevé</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php include_once('../layouts/footer.php'); ?>
