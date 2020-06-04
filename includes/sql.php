<?php
require_once('load.php');
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
    global $db;
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}
/*--------------------------------------------------------------*/
/* Function for Finding all antibodies
/*--------------------------------------------------------------*/

function find_all_antibodies(){
    $sql = "SELECT A.IdentifiantA,A.DesignationA,sum(c.volume) as 'QuantiteStock',A.SeuilAlerte,A.EtatStockA 
            FROM anticorps A,contenir c WHERE A.IdentifiantA =C.IdentifiantA
            GROUP BY  A.IdentifiantA,A.DesignationA,A.SeuilAlerte,A.EtatStockA";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for Finding all projects
/*--------------------------------------------------------------*/

function find_all_projects(){
    $sql = "SELECT * FROM projets";
    $result = find_by_sql($sql);
    return $result;
}
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
