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
/* Function for Finding all antibodies without left join
/*--------------------------------------------------------------*/

function find_all_antibodies_user()
{
    $sql = "SELECT Distinct  frs.IdentifiantF,frs.RaisonSocialeF,A.IdentifiantA,A.DesignationA,A.EtatStockA
          FROM anticorps A,fournir f ,fournisseurs frs 
          WHERE A.IdentifiantA = F.IdentifiantA
          AND F.IdentifiantF = Frs.IdentifiantF
          ";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for Finding all antibodies with left join providers
/*--------------------------------------------------------------*/

function find_all_antibodies()
{
    $sql = "SELECT Distinct  four.IdentifiantF ,four.RaisonSocialeF,four.SiteWebF,A.IdentifiantA ,A.DesignationA 
            ,A.SeuilAlerte,A.EtatStockA,
            (SELECT SUM(t.volume) FROM tubes t WHERE t.IdentifiantA = A.IdentifiantA ) as 'QuantiteStock'
            FROM anticorps A LEFT JOIN fournir f  ON A.IdentifiantA = f.IdentifiantA 
            left join fournisseurs four on four.IdentifiantF = f.IdentifiantF
            ";
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
    $sql = "SELECT T.referenceT ,T.volume,T.EtatTube
            FROM   tubes T
            WHERE  T.IdentifiantA = $IdentifiantA
            AND lower(T.EtatTube) <>'vide'";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for updating stock availibility of antibody
/*--------------------------------------------------------------*/

function update_availibility_stock ($Etat, $IdentifiantA)
{ global $db;
    $sql = "UPDATE anticorps  SET
          EtatStockA ='{$Etat}'
          WHERE IdentifiantA ='{$IdentifiantA}'";
    $result = $db->query($sql);

}

/*--------------------------------------------------------------*/
/* Function for Finding quantity in stock of antibody
/*--------------------------------------------------------------*/
function find_quantity_stock($IdentifiantA)
{
    $sql = "SELECT SUM(T.volume) as 'QuantiteStock'
            FROM   tubes T
            WHERE  T.IdentifiantA = $IdentifiantA ";
    $result = find_by_sql($sql);
    return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all tubes of antibody with open and close status
/*--------------------------------------------------------------*/
function find_tube_with_etat($IdentifiantA)
{
    $sql = "SELECT T.ReferenceT ,T.Volume
            FROM   tubes T
            WHERE  T.IdentifiantA = $IdentifiantA
            AND (lower(T.etatTube) ='ouvert' or lower(T.etatTube)='ferme')
            AND T.Volume<>0
            ORDER BY T.volume  limit 1";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for updating status tubes
/*--------------------------------------------------------------*/
function update_tube_etat($ReferenceT,$IdentifiantA,$newEtatTube,$newVolume)
{global $db;
    $sql = "UPDATE tubes SET EtatTube ='{$newEtatTube}',Volume='{$newVolume}'
                 WHERE ReferenceT = '{$ReferenceT}' AND IdentifiantA='{$IdentifiantA}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);
}
/*--------------------------------------------------------------*/
/* Function for finding clones of antibody
/*--------------------------------------------------------------*/
function find_clones_of_antibody($IdentifiantA)
{
    $sql = "SELECT C.LibelleC  FROM cloneanticorps CA, clones C
            WHERE C.IdentifiantC=CA.IdentifiantC
            AND CA.IdentifiantA = '{$IdentifiantA}'";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for finding species of antibody
/*--------------------------------------------------------------*/
function find_species_of_antibody($IdentifiantA)
{
    $sql = "SELECT  E.LibelleEsp FROM  especes E,especeanticorps EA
            WHERE E.IdentifiantEsp=EA.IdentifiantEsp
            AND EA.IdentifiantA = '{$IdentifiantA}'";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for finding Types of antibody
/*--------------------------------------------------------------*/
function find_Types_of_antibody($IdentifiantA)
{
    $sql = "SELECT T.LibelleType  FROM types T,typeanticorps TA
            WHERE T.IdentifiantType=TA.IdentifiantType
            AND TA.IdentifiantA = '{$IdentifiantA}'";
    $result = find_by_sql($sql);
    return $result;
}
/*--------------------------------------------------------------*/
/* Function for finding fluorochromes of antibody
/*--------------------------------------------------------------*/
function find_fluorochromes_of_antibody($IdentifiantA)
{
    $sql = "SELECT F.LibelleFluo  FROM fluorochromes F,fluorochromeanticorps FA
            WHERE F.IdentifiantFluo=FA.IdentifiantFluo
            AND FA.IdentifiantA = '{$IdentifiantA}'";
    $result = find_by_sql($sql);
    return $result;
}
?>

