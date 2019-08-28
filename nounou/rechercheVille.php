<?php
//Récupéré les noms des villes recherchées

include 'database.php';

//obtenir des données appariées de la table de ville

$term = $_GET['term'];
$requete = $bd->prepare('SELECT nomV FROM ville WHERE upper(nomV) LIKE upper(:term)'); //j'effectue ma requête SQL grâce au mot-clé LIKE
$requete->execute(array('term' => $term.'%'));
$array = array(); // on créé le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, $donnee['nomV']); // et on ajoute celles-ci à notre tableau
}

echo json_encode($array); // il n'y a plus qu'à convertir en JSON

?>
