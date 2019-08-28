<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 

define ('LO07_DB_USER', 'root');
define ('LO07_DB_PASSWORD', '');
define ('LO07_DB_HOST', 'mysql:host=localhost;dbname=nounou');
//define ('LO07_DB_NAME', 'nounou');

$database = mysqli_connect(LO07_DB_HOST, LO07_DB_USER, LO07_DB_PASSWORD, LO07_DB_NAME) or die ('Impossible de se connecter Ã  MySql : ' + mysqli_connect_error());
*/

// On déclare l'url d'accès du site
define('SITE_URL', 'http://localhost/nounou/');

// On définit la configuration mysql
$serveur = 'mysql:host=localhost;dbname=nounou';
$utilisateur = 'root';
$mot_de_passe = '';

function connect_bdd($serveur, $utilisateur, $mot_de_passe){

   
    try {
        $bd = new PDO($serveur, $utilisateur, $mot_de_passe);
        //echo "<p>BDD connectee</p>";
        return $bd;
    } catch (PDOException $e) {
        echo "La connexion a la base via la chaine [".$serveur."] a echouee".
            " pour la raison suivante: ".$e->getMessage();
        return false;
    }
}

$bd=connect_bdd($serveur, $utilisateur, $mot_de_passe);
$bd->query("SET NAMES UTF8;")
 ;
?>