<?php
session_start();
/*
 * FORMULAIRE DE RECHERCHE DE NOUNOU
 * +
 * ACTION DU FORMULAIRE
 */
include 'database.php';
include 'form.php';
include 'css.php';
include 'header.php';
require_once 'func_login.php';
require_once 'func_action.php';
redirectUnconnected('parent', SITE_URL . 'login_parent.php');
?><!DOCTYPE html>
<html lang="en">


    <head>

        <title>Looking For Nounou</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Tooplate">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


        <?php
        stylesheet("animate.css");
        stylesheet("bootstrap.min.css");
        stylesheet("font-awesome.min.css");
        stylesheet("owl.carousel.css");
        stylesheet("owl.theme.default.min.css");
// Main CSS tooplate-style.css
        stylesheet("tooplate-style.css");
        ?>

    </head>
    <body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


        <!-- PRE LOADER -->
        <section class="preloader">
            <div class="spinner">

                <span class="spinner-rotate"></span>

            </div>
        </section>

        <!-- PARTIE FORMULAIRE-->
        <section id="appointment" data-stellar-background-ratio="3">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 col-sm-12">
                        <!-- FORMULAIRE RECHERCHE NOUNOU -->
                        <form id="appointment-form" role="form" method="post" action="form_recherche_nounou_action.php" enctype="multipart/form-data">

                            <!-- SECTION TITLE -->
                            <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                <h2 align="center">A la recherche d'une nounou ?</h2>
                            </div>

                            <div class="wow fadeInUp" data-wow-delay="0.8s">

                                <!-- Ville -->

                                <div class="col-md-0 col-sm-4 ui-widget">
                                    <label for="nomV">Ville</label></p>
                                <input id="nomV" type="text" name="nomV"
                                    <?php
                                    if (isset($_POST['nomV']) && !empty($_POST['nomV'])) {
                                        echo ('value="' . $_POST['nomV'] . '"');
                                    } else {
                                        echo('placeholder="Votre ville"');
                                    }
                                    ?>
                                           ">
                                </div>

                                <!-- Département -->

                                <!-- Faire en sorte que l'utilisateur ne saisisse que des chiffres
                                et surtout que lorsqu'il saisit la ville, que ça change automatiquement le num du département
                                
                                <div class="col-md-3 col-sm-6">
                                    <label for="dep">Departement</label>
                                    <input id="nomV" type="text" name="dep" placeholder="Votre departement">
                                </div>--> 

                                <!-- Plage horaire -->

                                <div class="col-md-4 col-sm-12">
                                    <label>Garde ponctuelle </label><p></p>
                                    <input type="date" name="dispo[date]" value="<?php
                                    if (isset($_POST['dispo']['date'])) {
                                        echo ($_POST['dispo']['date']);
                                    }
                                    ?>" required> 
                                    de <input type="time" name="dispo[heureD]" value="<?php
                                    if (isset($_POST['dispo']['heureD'])) {
                                        echo ($_POST['dispo']['heureD']);
                                    }
                                    ?>" required> 
                                    à <input type="time" name="dispo[heureF]" value="<?php
                                    if (isset($_POST['dispo']['heureF'])) {
                                        echo ($_POST['dispo']['heureF']);
                                    }
                                    ?>" required>.
                                </div></p>

                                <!-- Langue parlée -->
                                <!-- ????????????? -->

                                <button type="submit" class="form-control" id="cf-submit">Rechercher</button>

                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <script>
                $(function () {
                    $("#nomV").autocomplete({
                        source: 'rechercheVille.php',
                        minLength: 2 // on indique qu'il faut taper au moins 3 caractères pour afficher l'autocomplétion
                    });
                });
            </script>

        </section>

        <?php
        // RECUPERATION DES DONNEE(S) SAISIE(S) PAR L'UTILISATEUR

        /*
         * 2 cas possibles :
         * - les parents font seulement une recherche sur la plage horaire : affichage de toutes les nounous disponible sur ce créneau
         * - les parents font une recherche sur la ville ET la plage horaire : affichage de toutes les nounous disponible sur ce créneau et dans cette ville
         * 
         * A.N. : le cas d'affichage de toutes les nounous n'est pas possible ici
         */
        //var_dump($_POST);
        //var_dump(verifyEmptyName(['nomV']));

        /*
         * TYPES DE RECHERCHES A METTRE DANS LA BOUCLE TANT QUE
         */

// Création du tableau des nounous en lien avec la recherche
        echo'<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Prenom</th>
      <th scope="col">Nom</th>
      <th scope="col">Date de Naissance</th>
      <th scope="col">Ville</th>
      <th scope="col">Réserver</th>
    </tr>
  </thead>
  <tbody>';


        // On recupere tout le contenu de la table nounou
        $reponse = $bd->query('SELECT nounou.idN, prenomN, nomN, dateN, depcom, date, heureD, heureF'
                . ' FROM disponibilite, nounou '
                . 'WHERE  nounou.idN = disponibilite.idN and disponibilite.disponible = 1 AND bloqueN = 0');

        if (verifyDefinedName(['dispo[date]', 'dispo[heureD]', 'dispo[heureF]', 'nomV'])) {

            $nomVRecherche = $_POST['nomV'];
            $dateRecherche = $_POST['dispo']['date'];
            $heureDRecherche = $_POST['dispo']['heureD'];
            $heureFRecherche = $_POST['dispo']['heureF'];


            //$resultatRechercheNounou = $executeRechercheNounouDispo->fetchAll();


            if (!empty($_POST['dispo']['date']) && !empty($_POST['dispo']['heureD']) && !empty($_POST['dispo']['heureF']) && empty($_POST['nomV'])) {
                //L'utilisateur a seulement realise une recherche sur une plage horaire mais pas sur une ville
                echo "L'utilisateur a seulement realise une recherche sur une plage horaire mais pas sur une ville";
                while ($donnees = $reponse->fetch()) {
                    //On affiche les données dans le tableau
                    // On vérifie dans un premier temps que les champs saisis
                    // correspondent à la nounou qui va s'afficher
                    // Equivalent depcom - nom ville

                    $requete1 = $bd->query("SELECT nomV FROM ville WHERE  depcom = '" . $donnees['depcom'] . "';");
                    //var_dump($requete1);
                    $nomV = $requete1->fetch();
                    //var_dump($depcom);
                    $nomV = $nomV[0];


                    $requeteA = $bd->query("SELECT heureD FROM disponibilite WHERE  heureD = '" . $donnees['heureD'] . "';");
                    $heureD = $requeteA->fetch();
                    $heureD = $heureD[0];


                    $requeteB = $bd->query("SELECT heureF FROM disponibilite WHERE  heureF = '" . $donnees['heureF'] . "';");
                    $heureF = $requeteB->fetch();
                    $heureF = $heureF[0];

                    $requeteC = $bd->query("SELECT date FROM disponibilite WHERE  date = '" . $donnees['date'] . "';");
                    $date = $requeteC->fetch();
                    $date = $date[0];
                    /*
                     * echo($donnees['prenomN'].' '.$donnees['nomN']);

                      var_dump($heureD);
                      var_dump($heureDRecherche);
                      var_dump($heureD >= $heureDRecherche);

                      var_dump($heureF);
                      var_dump($heureFRecherche);
                      var_dump($heureF <= $heureFRecherche);

                      var_dump($date);
                      var_dump($dateRecherche);
                      var_dump($date == $dateRecherche); */

                    if (($heureD <= $heureDRecherche) && ($heureF >= $heureFRecherche) && ($date == $dateRecherche)) {

                        // Nous devons étudier le fait qu'une nounou ne doit pas apparaître 2 fois !
                        // A moins que l'on part de l'idée qu'il se n'est pas possible

                        echo "<tr>";
                        echo "<td> $donnees[prenomN] </td>";
                        echo "<td> $donnees[nomN] </td>";
                        echo "<td> $donnees[dateN] </td>";


                        echo "<td> $nomV </td>";

                        // Bouton de réservation
                        // Ouverture d'un formulaire, et tous les champs sont hidden (valeurs ci-dessus)
                        // Et la méthode post ira vers form_reservation_action.php
                        // /!\ RAJOUTER DES HIDDENS DE L'HEURE ET DE LA DATE /!\ 



                        echo'<td> <form id="appointment-form" role="form" method="post" action="form_reservation.php" enctype="multipart/form-data">'
                        . '<input type="hidden" name="idN"  value="' . $donnees['idN'] . '" />'
                        . '<input type="hidden" name="nomNounou"  value="' . $donnees['nomN'] . '" />' .
                        '<input name="prenomNounou" type="hidden" value="' . $donnees['prenomN'] . '" />'
                        . '<input type="hidden" name="dateReserv" value="' . $_POST['dispo']['date'] . '" />'
                        . '<input type="hidden" name="heureDReserv" value="' . $_POST['dispo']['heureD'] . '" />'
                        . '<input type="hidden" name="heureFReserv" value="' . $_POST['dispo']['heureF'] . '" />'
                        . '<button type="submit" class="form-control" id="cf-submit">Réserver</button>'
                        . '</form></td>';

                        echo "</tr>";
                    }
                }
            } else if (!empty($_POST['dispo']['date']) && !empty($_POST['dispo']['heureD']) && !empty($_POST['dispo']['heureF']) && !empty($_POST['nomV'])) {
                //L'utilisateur a realise une recherche sur une plage horaire ET sur une ville
                echo "L'utilisateur a realise une recherche sur une plage horaire ET sur une ville";
                while ($donnees = $reponse->fetch()) {
                    //On affiche les données dans le tableau
                    // On vérifie dans un premier temps que les champs saisis
                    // correspondent à la nounou qui va s'afficher
                    // Equivalent depcom - nom ville

                    $requete1 = $bd->query("SELECT nomV FROM ville WHERE  depcom = '" . $donnees['depcom'] . "';");
                    //var_dump($requete1);
                    $nomV = $requete1->fetch();
                    //var_dump($depcom);
                    $nomV = $nomV[0];


                    $requeteA = $bd->query("SELECT heureD FROM disponibilite WHERE  heureD = '" . $donnees['heureD'] . "';");
                    $heureD = $requeteA->fetch();
                    $heureD = $heureD[0];


                    $requeteB = $bd->query("SELECT heureF FROM disponibilite WHERE  heureF = '" . $donnees['heureF'] . "';");
                    $heureF = $requeteB->fetch();
                    $heureF = $heureF[0];

                    $requeteC = $bd->query("SELECT date FROM disponibilite WHERE  date = '" . $donnees['date'] . "';");
                    $date = $requeteC->fetch();
                    $date = $date[0];
                    /*
                     * echo($donnees['prenomN'].' '.$donnees['nomN']);

                      var_dump($heureD);
                      var_dump($heureDRecherche);
                      var_dump($heureD >= $heureDRecherche);

                      var_dump($heureF);
                      var_dump($heureFRecherche);
                      var_dump($heureF <= $heureFRecherche);

                      var_dump($date);
                      var_dump($dateRecherche);
                      var_dump($date == $dateRecherche); */

                    if (($heureD <= $heureDRecherche) && ($heureF >= $heureFRecherche) && ($date == $dateRecherche) && ($nomV == $nomVRecherche)) {

                        // Nous devons étudier le fait qu'une nounou ne doit pas apparaître 2 fois !
                        // A moins que l'on part de l'idée qu'il se n'est pas possible

                        echo "<tr>";
                        echo "<td> $donnees[prenomN] </td>";
                        echo "<td> $donnees[nomN] </td>";
                        echo "<td> $donnees[dateN] </td>";


                        echo "<td> $nomV </td>";

                        // Bouton de réservation
                        // Ouverture d'un formulaire, et tous les champs sont hidden (valeurs ci-dessus)
                        // Et la méthode post ira vers form_reservation_action.php
                        // /!\ RAJOUTER DES HIDDENS DE L'HEURE ET DE LA DATE /!\ 
                        echo'<td> <form id="appointment-form" role="form" method="post" action="form_reservation.php" enctype="multipart/form-data">'
                        . '<input name="idN" type="hidden" value="' . $donnees['idN'] . '" />'
                        . '<input name="prenomNounou" type="hidden" value="' . $donnees['prenomN'] . '" />'
                        . '<input name="nomNounou" type="hidden" value="' . $donnees['nomN'] . '" />'
                        . '<input name="dateReserv" type="hidden" value="' . $_POST['dispo']['date'] . '" />'
                        . '<input name="heureDReserv" type="hidden" value="' . $_POST['dispo']['heureD'] . '" />'
                        . '<input name="heureFReserv" type="hidden" value="' . $_POST['dispo']['heureF'] . '" />'
                        . '<button type="submit" class="form-control" id="cf-submit">Réserver</button>'
                        . '</form></td>';

                        echo "</tr>";
                    }
                }
            } else {
                echo "Aucun champ rempli";
                var_dump($_POST['dispo']['date']);
            }
        } else {
            echo "Aucun champ n'est défini";
        }










        echo '</tbody></table>';

        $reponse->closeCursor();


//<!-- SCRIPTS -->

        script("bootstrap.min.js");
        script("jquery.sticky.js");
        script("jquery.stellar.min.js");
        script("wow.min.js");
        script("smoothscroll.js");
        script("owl.carousel.min.js");
        script("custom.js");
        ?>

    </body>
</html>






