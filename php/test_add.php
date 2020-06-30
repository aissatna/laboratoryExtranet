<?php
//print_r($_POST['data']);

//$antiboiesIDS=array();
//foreach ($_POST['data'] as $key => $value) {
//    foreach ($value as $sub_key => $sub_val) {
//
//        array_push($antiboiesIDS,$sub_val);
//
//    }
//}
//foreach ($antiboiesIDS as $key=>$antiboiesID)
//echo $antiboiesID;
$query  = explode('&', $_POST['data']);
$params = array();

foreach( $query as $param )
{
    // prevent notice on explode() if $param has no '='
    if (strpos($param, '=') === false) $param += '=';

    list($name, $value) = explode('=', $param, 2);
    $params[urldecode($name)][] = urldecode($value);
}
print_r($params['antibody'])
?>