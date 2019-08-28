<?php

/*
 * 
 * FORM ENFANT ACTION PHP
 * 
 * 
 */
require_once 'func_action.php';
require_once 'func_login.php';
require_once 'database.php';

// On vérifie que l'utilisateur est bien passé par le boutton submit.
if (verifyDefinedName(['prenomE[]', 'dateE[]', 'restrE[]', 'infoE[]', 'idP', 'nbEnfants'])) {

    // On vérifie que l'utilisateur a rempli chaque champ.
    if (verifierChamps()) {
        
        var_dump($_POST);
        $nbEnfants = $_POST['nbEnfants'];$idP = $_POST['idP'];
        
        for ($nbEnfInscrit = 0; $nbEnfInscrit < $nbEnfants; $nbEnfInscrit = $nbEnfInscrit + 1) {
        
        
        $prenomE[$nbEnfInscrit] = addslashes($_POST['prenomE'][$nbEnfInscrit]);
        var_dump($prenomE[$nbEnfInscrit]);
        
        $dateE[$nbEnfInscrit] = addslashes($_POST['dateE'][$nbEnfInscrit]);
        var_dump($dateE[$nbEnfInscrit]);
        
        $restrE[$nbEnfInscrit] = addslashes($_POST['restrE'][$nbEnfInscrit]);
        var_dump($restrE[$nbEnfInscrit]);
        
        $infoE[$nbEnfInscrit] = addslashes($_POST['infoE'][$nbEnfInscrit]);
        var_dump($infoE[$nbEnfInscrit]);
        

        // Champ caché : idP

        
        
        // Insertion dans la table Enfant

        $requeteA = "INSERT INTO enfant (prenomE, dateE, restrE, infoE) VALUES ('" . $prenomE[$nbEnfInscrit] . "', '" . $dateE[$nbEnfInscrit] . "', '" . $restrE[$nbEnfInscrit] . "', '" . $infoE[$nbEnfInscrit] . "')";
        $bd->exec($requeteA);

        // Recherche idE
        
        // Ici : on part de l'idée que les enfants inscrits ne peuvent pas s'appeler pareil et être né le même jour
        $requeteB = $bd->query("SELECT idE FROM enfant WHERE  prenomE = '" . $prenomE[$nbEnfInscrit] . "' AND dateE ='".$dateE[$nbEnfInscrit]."';");
        var_dump($requeteB);
        $idE = $requeteB->fetch();
        var_dump($requeteB);
        $idE = $idE[0];

        // On lie parent et enfant
        
        $requeteC = "INSERT INTO lie (idE,idP) VALUES ('" . $idE . "', '" . $idP . "')";
        var_dump($requeteC);
        $bd->exec($requeteC);
        
        }
        //echo"Inscription réussie !";
        
        /*
         * TENTATIVE D'AJOUTER +SIEURS ENFANTS
        if($nbEnfants === 0){
            echo "Vous avez inscrits tous vos enfants";
        } else { // il reste des enfants à inscrire
            echo "Place au suivant !";
            include('form_enfant.php');
        }*/
        
        header('Location: ' . SITE_URL . 'login.php');
        exit();

        
    } else {
        echo "Votre enfant déjà inscrit";
    }
} else {
    echo "Inscription incomplète !";
}
