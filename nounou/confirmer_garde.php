<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// On vérifie que le parent est bien connecté.

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'parent') {
        // On vérifie s'il a envoyé le formulaire de confirmation de garde
        if (isset($_POST['idN'])) {
            var_dump($_POST['heureDreel']);
            $heureDreel = date_create_from_format("G:i", $_POST['heureDreel']);
            $heureFreel = date_create_from_format("G:i", $_POST['heureFreel']);           
//            var_dump($heureFreel);
            $diff = date_diff($heureDreel, $heureFreel);
//            var_dump($diff);
            $heuresGarde = $diff->h;
            if ($diff->i > 0) {
                $heuresGarde = $heuresGarde + 1;
            }
            // On protége les guillements dans la zone appréciation
            $appreciation = addslashes($_POST['appreciation']);
            // On formate l'heure au format SQL
            $heureDreel = $_POST['heureDreel'] . ':00';
            $heureFreel = $_POST['heureFreel']. ':00';
            $nbEnfantsSupp = $_POST['nbEnfantsGardes'] - 1;
            
            
            $coutTotal = $heuresGarde * (7 + 4 * $nbEnfantsSupp);
//            var_dump($_POST);
            $query="UPDATE garde SET cout=".$coutTotal. ", note=".$_POST['note'].", appreciation='".$appreciation."', heureDreel='" . $heureDreel."', heureFreel='". $heureFreel. "' WHERE idN=". $_POST['idN']. " AND date='". $_POST['date']. "' AND heureD='".$_POST['heureD']. "' AND heureF='".$_POST['heureF']."';";
//            var_dump($query);
            $bd->query($query);
        }
    }
}