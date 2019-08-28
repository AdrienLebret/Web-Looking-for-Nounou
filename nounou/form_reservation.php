<?php
/*
 * 
 * FORM PARENT ACTION PHP
 * 
 * 
 */
session_start();
require_once 'func_action.php';
require_once 'func_login.php';
require_once 'database.php';
require_once 'form.php';
require_once 'css.php';
require_once 'header.php';
redirectUnconnected('parent', SITE_URL . 'login_parent.php');
?>


<!DOCTYPE html>

<html lang="fr">


    <head>

        <title>Looking For Nounou - Réservation</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Tooplate">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <script src='<?php echo SITE_URL . "js/jquery-last.js"; ?>'></script>
        <script src='<?php echo SITE_URL . "js/jquery-last-ui.js"; ?>'></script>


<?php
stylesheet("animate.css");
stylesheet("bootstrap.min.css");
stylesheet("font-awesome.min.css");
stylesheet("owl.carousel.css");
stylesheet("owl.theme.default.min.css");
stylesheet("tooplate-style.css");
?>

    </head>
    <body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<?php
/*
 * 
 * FORM ENFANT PHP
 * 
 * 
 */
?>
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

                    <!-- FORMULAIRE RESERVATION NOUNOU -->

<?php
// On vérifie que l'utilisateur est bien passé par le boutton submit.
if (verifyDefinedName(['idN', 'dateReserv', 'heureDReserv', 'heureFReserv'])) {
    if (verifyDefinedName(['enfant'])) {
        foreach ($_POST['enfant'] as $idEnfant) {
            $ajouterGarde = $bd->prepare('INSERT INTO garde (idE, idN, date, heureD, heureF) VALUES (:idE, :idN, :date, :heureD, :heureF);');
            $ajouterGarde->execute(array(
                ':idE' => $idEnfant,
                ':idN' => $_POST['idN'],
                'date' => $_POST['dateReserv'],
                ':heureD' => $_POST['heureDReserv'],
                ':heureF' => $_POST['heureFReserv']
            ));
        }
        $changerDispoNounou = $bd->query('UPDATE disponibilite SET disponible = 0 WHERE idN=' . $_POST['idN'] . ';');
        echo "Votre réservation a bien été prise en compte.";
        echo "<script>setTimeout(window.location='./',500000);</script>";
    } else {
        // On vérifie que l'utilisateur a rempli chaque champ.
        if (verifierChamps()) {
            //var_dump($_POST);
            // Le formulaire transmet id de la nounou
            // Nous voulons son nom et son prenom
            $requeteEnfant = $bd->query('SELECT DISTINCT l.idE, prenomE FROM enfant e, lie l, parent p WHERE l.idP =' . $_SESSION['id'] . ' AND l.idE = e.idE;');
            $enfant = $requeteEnfant->fetchAll();
//            var_dump($enfant);
//        $ajoutGarde = $bd->prepare('INSERT INTO garde (idE, idN, date, heureD, heureF) VALUES (')
//        $idN = $_POST['idN'];
            $dateReserv = $_POST['dateReserv'];
            $heureDReserv = $_POST['heureDReserv'];
            $heureFReserv = $_POST['heureFReserv'];
        } else {
            echo "Tous les champs n'ont pas été envoyé !";
        }
        echo "<h3>Vous souhaitez faire garder vos enfants le " . date("d-m-Y", strtotime($_POST['dateReserv'])) . " de " . $_POST['heureDReserv'] . " à " . $_POST['heureFReserv'] . " par " . $_POST['prenomNounou'] . " " . $_POST['nomNounou'] . " </h3><br>";
        echo '<form id="appointment-form" role="form" method="post" action="form_reservation.php" enctype="multipart/form-data">';
        echo "Sélectionnez les enfants que vous souhaitez faire garder : <br>";
        
        foreach ($enfant as $key) {
            echo "<input id='" . $key['idE'] . "' type='checkbox' name='enfant[]' value=" . $key['idE'] . "><label for='" . $key['idE'] . "' >" . $key['prenomE'] . "</label><br>";
            echo "<input type='hidden' name='dateReserv' value='" . $_POST['dateReserv'] . "'>";
            echo "<input type='hidden' name='heureDReserv' value='" . $_POST['heureDReserv'] . "'>";
            echo "<input type='hidden' name='heureFReserv' value='" . $_POST['heureFReserv'] . "'>";
            echo "<input type='hidden' name='prenomNounou' value='" . $_POST['prenomNounou'] . "'>";
            echo "<input type='hidden' name='nomNounou' value='" . $_POST['nomNounou'] . "'>";
            echo "<input type='hidden' name='idN' value='" . $_POST['idN'] . "'>";
            
        }
        echo "<button type='submit'>Réserver</button>

                    </form> ";
    }
}
?>

                             
                </div>

            </div>
        </div>
    </section>


    <!-- SCRIPTS -->
<?php
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
