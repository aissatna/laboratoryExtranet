<?php
//Données de la connection a la BD
define('host', 'localhost');
define('login', 'root');
define('password', '');
define('dbName', '........');
// Fonction pour la connexion a la BD de l'application
function mysqlConnectDB()
{
    // Connexion a la base de données
    $connDB = mysqli_connect(host, login, password, dbName);
    // Check connexion
    if ($connDB === false) {
        die("ERROR: Could not connect DB. " . mysqli_connect_error());
    } else {
        return $connDB;
    }
}
?>
