<?php
session_start();
require_once 'database.php';
require_once 'form.php';
require_once 'css.php';
require_once 'func_login.php';
require_once 'form.php';
require_once 'func_action.php';
redirectUnconnected('nounou', SITE_URL . 'login_nounou.php');
?>


<div class="col-md-12 col-sm-12">
    <?php
//    var_dump($_POST);
    if (verifierChamps()) {
        //Si le choix a été fait d'ajouter une disponibilité récurrente, on récupère laquelle.
        $recurrence = $_POST['recurrence'];
        if ($dispoRecurrente = 'on') {
            if ($recurrence === "a-des-heures-differentes-toute-la-semaine") {
                if (isset($_POST['joursDispo'])) {
                    $joursDispo = $_POST['joursDispo'];
                    foreach ($joursDispo as $key) {
                        $name = 'creneaux' . $key;
                        $heureD = $_POST[$name][0];
                        $heureF = $_POST[$name][1];
                        $jours = numJours($key);
                        if (!empty($heureD) && !empty($heureF)) {
                            if (!verifyRecurrenceAlreadySaved($bd, $_SESSION['id'], $jours, $heureD, $heureF)) {
                                $query = "INSERT INTO disponibilite (idN, recurrence, heureD, heureF) VALUES ('" . $_SESSION['id'] . "' , '" . $jours . "', '" . $heureD . "', '" . $heureF . "');";
                                var_dump($query);
                                $bd->query($query);
                            }
                        }
                    }
                }
            } else if ($recurrence === "tous-les-jours-travailles") {
                for ($i = 0; $i < 6; $i++) {
                    $joursSelectionnes[] = $listeJours[$i];
                }
                $joursSelectionnes = normaliser_array($joursSelectionnes);
                foreach ($joursSelectionnes as $key) {
                    $heureD = $_POST['creneauxD'][0];
                    $heureF = $_POST['creneauxD'][1];
                    $jours = numJours($key);
                    if (!empty($heureD) && !empty($heureF)) {
                        if (!verifyRecurrenceAlreadySaved($bd, $_SESSION['id'], $jours, $heureD, $heureF)) {
                            $query = "INSERT INTO disponibilite (idN, recurrence, heureD, heureF) VALUES ('" . $_SESSION['id'] . "' , '" . $jours . "', '" . $heureD . "', '" . $heureF . "');";
                            var_dump($query);
                            $bd->query($query);
                        }
                    }
                }
            } else if ($recurrence === "tous-les-jours") {
                for ($i = 0; $i < sizeof($listeJours); $i++) {
                    $joursSelectionnes[] = $listeJours[$i];
                }
                echo 'joursSelections';

                $joursSelectionnes = normaliser_array($joursSelectionnes);
                foreach ($joursSelectionnes as $key) {
                    $heureD = $_POST['creneauxD'][0];
                    $heureF = $_POST['creneauxD'][1];
                    $jours = numJours($key);
                    if (!empty($heureD) && !empty($heureF)) {
                        if (!verifyRecurrenceAlreadySaved($bd, $_SESSION['id'], $jours, $heureD, $heureF)) {
                            $query = "INSERT INTO disponibilite (idN, recurrence, heureD, heureF) VALUES ('" . $_SESSION['id'] . "' , " . $jours . ", '" . $heureD . "', '" . $heureF . "');";
                            $bd->query($query);
                        }
                    }
                }



                if (isset($_POST['dispo'])) {

                    $dateDispoPonctuelle = $_POST['dispo']['date'];
                    $heureD = $_POST['dispo']['heureD'];
                    $heureF = $_POST['dispo']['heureF'];
echo 'je suis là';
                    

                    for ($i = 0; $i < sizeof($dateDispoPonctuelle); $i++) {
                        if (!empty($heureD[$i]) && !empty($heureF[$i])) {
                            echo 'je suis mtn ici';
                            if (!verifyPonctuelleAlreadySaved($bd, $_SESSION['id'], $dateDispoPonctuelle[$i], $heureD[$i], $heureF[$i])) {
                                $query = "INSERT INTO disponibilite (idN, date, heureD, heureF) VALUES (" . $_SESSION['id'] . " , '" . $dateDispoPonctuelle[$i] . "', '" . $heureD[$i] . "', '" . $heureF[$i] . "');";
                                var_dump($query);
                                $bd->query($query);
                            }
                        }
                    }
                }
            }
        }
        echo "Vos disponibilités ont bien été ajoutées. Vous allez être redirigés vers votre profil.";
        echo redirectConnexion('nounou', $_SESSION['id']);
    }
    ?>