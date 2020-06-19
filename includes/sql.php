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

function find_all_antibodies()
{
    $sql = "SELECT frs.identifiantF,frs.RaisonSocialeF,frs.SiteWebF,A.IdentifiantA,A.DesignationA,C.LibelleC,
          (SELECT SUM(C.volume) FROM contenir C WHERE C.IdentifiantA = A.IdentifiantA ) as 'QuantiteStock',
          A.SeuilAlerte,A.EtatStockA
          FROM anticorps A,fournir f ,fournisseurs frs ,clones C ,cloneanticorps CA
          WHERE A.IdentifiantA = F.IdentifiantA
          AND F.IdentifiantF = Frs.IdentifiantF
          AND A.IdentifiantA = CA.IdentifiantA
          AND CA.IdentifiantC =C.IdentifiantC
          GROUP BY  frs.RaisonSocialeF ,A.IdentifiantA,A.DesignationA,A.SeuilAlerte,A.EtatStockA";
    $result = find_by_sql($sql);
    return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all projects with team
/*--------------------------------------------------------------*/

function find_all_projects()
{
    $sql = "SELECT * FROM projets P,travailler T,equipes E WHERE
    P.IdentifiantP= T.IdentifiantP AND T.IdentifiantE = E.IdentifiantE;";
    $result = find_by_sql($sql);
    return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all species
/*--------------------------------------------------------------*/
function find_all_species()
{
    $sql = "SELECT * FROM especes";
    $result = find_by_sql($sql);
    return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all isotypes
/*--------------------------------------------------------------*/
function find_all_isotypes()
{
    $sql = "SELECT * FROM Types";
    $result = find_by_sql($sql);
    return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all clones
/*--------------------------------------------------------------*/
function find_all_clones()
{
    $sql = "SELECT * FROM clones";
    $result = find_by_sql($sql);
    return $result;

}

/*--------------------------------------------------------------*/
/* Function for Finding all clones
/*--------------------------------------------------------------*/
function find_all_fluorochromes()
{
    $sql = "SELECT * FROM Fluorochromes";
    $result = find_by_sql($sql);
    return $result;

}

/*--------------------------------------------------------------*/
/* Function for Finding all teams
/*--------------------------------------------------------------*/
function find_all_teams()
{
    $sql = "SELECT * FROM equipes";
    $result = find_by_sql($sql);
    return $result;

}
/*--------------------------------------------------------------*/
/* Function for Finding all providers
/*--------------------------------------------------------------*/
function find_all_providers()
{
    $sql = "SELECT * FROM fournisseurs";
    $result = find_by_sql($sql);
    return $result;

}

/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
/* coming from the login form.
/*--------------------------------------------------------------*/
function authenticate($username = '', $password = '')
{
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql = sprintf("SELECT IdentifiantG ,Login,MotDePasse FROM gestionnaire WHERE Login ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if ($db->num_rows($result)) {
        $user = $db->fetch_assoc($result);
        if ($password === $user['MotDePasse']) {
            return $user['IdentifiantG'];
        }
    }
    return false;
}

/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table)
{
    global $db;
    $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
    if ($table_exit) {
        if ($db->num_rows($table_exit) > 0)
            return true;
        else
            return false;
    }
}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table, $id, $idFieldName)
{
    global $db;
    $id = (int)$id;
    if (tableExists($table)) {
        $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($idFieldName)} = {$db->escape($id)} LIMIT 1");
        if ($result = $db->fetch_assoc($sql))
            return $result;
        else
            return null;
    }
}

/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table, $id, $idFieldName)
{
    global $db;
    if (tableExists($table)) {
        $sql = "DELETE FROM " . $db->escape($table);
        $sql .= " WHERE " . $db->escape($idFieldName) . " = " . $db->escape($id);
        $sql .= " LIMIT 1";
        $db->query($sql);
        return ($db->affected_rows() === 1) ? true : false;
    }
}

/*--------------------------------------------------------------*/
/*  Function to check the existence of a field
/*--------------------------------------------------------------*/
function find_by_field($table, $filed, $FieldName)
{
    global $db;
    if (tableExists($table)) {
        $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($FieldName)} = '{$db->escape($filed)}' ");
        if ($result = $db->fetch_assoc($sql))
            return $result;
        else
            return null;
    }
}

/*--------------------------------------------------------------*/
/*  Function for Find Max id  from table
/*--------------------------------------------------------------*/
function find_max_id($table, $idFieldName)
{
    global $db;
    if (tableExists($table)) {
        $sql = $db->query("SELECT Max($idFieldName) as 'MaxId'FROM {$db->escape($table)}  LIMIT 1");
        if ($result = $db->fetch_assoc($sql))
            return $result;
        else
            return null;
    }
}

/*--------------------------------------------------------------*/
/* Function for Finding all tubes of antibody
/*--------------------------------------------------------------*/
function find_all_tubes($IdentifiantA)
{
    $sql = "SELECT T.referenceT ,C.volume,T.EtatTube
            FROM   tubes T , contenir C
            WHERE  T.referenceT = C.referenceT
            AND    C.IdentifiantA = $IdentifiantA
            AND T.EtatTube <>'vide'";
    $result = find_by_sql($sql);
    return $result;
}

?>
