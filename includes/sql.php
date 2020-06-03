<?php
require_once('load.php');
/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
/* coming from the login form.
/*--------------------------------------------------------------*/
function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT IdentifiantG ,Login,MotDePasse FROM gestionnaire WHERE Login ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
        $user = $db->fetch_assoc($result);
        if($password === $user['MotDePasse'] ){
            return $user['IdentifiantG'];
        }
    }
    return false;
}
?>
