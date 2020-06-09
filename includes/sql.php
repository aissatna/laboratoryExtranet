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
/* Function for Finding all species
/*--------------------------------------------------------------*/
function find_all_species(){
    $sql = "SELECT * FROM especes";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for Finding all isotypes
/*--------------------------------------------------------------*/
function find_all_isotypes(){
    $sql = "SELECT * FROM Types";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for Finding all clones
/*--------------------------------------------------------------*/
function find_all_clones(){
    $sql = "SELECT * FROM clones";
    $result = find_by_sql($sql);
    return $result;

}
/*--------------------------------------------------------------*/
/* Function for Finding all clones
/*--------------------------------------------------------------*/
function find_all_fluorochromes(){
    $sql = "SELECT * FROM Fluorochromes";
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
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
    global $db;
    $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
    if($table_exit) {
        if($db->num_rows($table_exit) > 0)
            return true;
        else
            return false;
    }
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id,$idFieldName)
{
    global $db;
    $id = (int)$id;
    if(tableExists($table)){
        $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($idFieldName)} = {$db->escape($id)} LIMIT 1");
        if($result = $db->fetch_assoc($sql))
            return $result;
        else
            return null;
    }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id,$idFieldName)
{
    global $db;
    if(tableExists($table))
    {
        $sql = "DELETE FROM ".$db->escape($table);
        $sql .= " WHERE ".$db->escape($idFieldName)."=". $db->escape($id);
        $sql .= " LIMIT 1";
        $db->query($sql);
        return ($db->affected_rows() === 1) ? true : false;
    }
}
?>
