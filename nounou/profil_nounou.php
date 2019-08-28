<?php
session_start();
require_once 'database.php';
require_once 'form.php';
require_once 'func_action.php';
require_once 'func_login.php';
require_once 'css.php';

if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    $queryProfileNounou = $bd->prepare('SELECT prenomN, nomN, dateN, presentationN, experienceN, photoN, emailN FROM nounou WHERE idN=:idN;');
    $queryProfileNounou->execute(array(
        ':idN' => $id
    ));
    $resProfileNounou = $queryProfileNounou->fetchAll();
//    var_dump($resProfileNounou);
    $prenom = $resProfileNounou[0][0];
    $nom = $resProfileNounou[0][1];

// On récupère la date de naissance, la date du jour et on stock l'intervalle dans une variable qu'on réutilise pour dire l'âge.
    $dateNaissance = new DateTime($resProfileNounou[0][2]);
    $dateAujourdhui = date("Y-m-d");
//var_dump($dateAujourdhui);
    $joursARetirer = date("N") - 1;
//    var_dump($joursARetirer);
    $debutSemaine = new DateTime();
    $debutSemaine = $debutSemaine->format('Y-m-d');
    $debutSemaine = date('Y-m-d', strtotime("-$joursARetirer  day"));

    $joursAajouter = 6 - date("N") + 1;
    $finSemaine = new DateTime($debutSemaine);
    $finSemaine = $finSemaine->format('Y-m-d');
    $finSemaine = date('Y-m-d', strtotime("+$joursAajouter  day"));
//var_dump($finSemaine);
//var_dump($debutSemaine);
    $dateAujourdhui = new DateTime($dateAujourdhui);
//    $debutSemaine = date($dateAujourdhui,  "-$joursARetirer day");
//    $debutSemaine  = mktime(0, 0, 0, date("m")  , date("d")-$joursARetirer, date("Y"));
//        echo $debutSemaine;
    $interval = $dateAujourdhui->diff($dateNaissance);

    $presentation = $resProfileNounou[0][3];
    $experience = $resProfileNounou[0][4];
    $photo = $resProfileNounou[0][5];
    $email = $resProfileNounou[0][6];
} else {
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <title>Looking for Nounou.com - Connection</title>
        <!--
        
        Template 2098 Health
        
        http://www.tooplate.com/view/2098-health
        
        -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Tooplate">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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


        <?php include 'menu.php'; ?>


        <!-- MAKE AN APPOINTMENT -->
        <section id="container" data-stellar-background-ratio="3">
            <div class="container">
                <div class="row">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4 col-sm-4" champProfile top>
                            <img src="<?php echo SITE_URL . "avatars/" . $photo; ?>" height="150">
                        </div>
                        <div class="col-md-6 col-sm-8" description top>
                            <h2><?php
                                echo $resProfileNounou[0][0];
                                echo " " . $nom;
                                ?></h2>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4 col-sm-6 champProfile">
                            Âge
                        </div>
                        <div class="col-md-6 col-sm-6 description">
                            <?php echo $interval->format('%y ans'); ?>
                        </div>

                        <div class="col-md-2"></div>
                        <div class="col-md-4 col-sm-6 champProfile">
                            <b>Adresse mail</b>
                        </div>
                        <div class="col-md-6 col-sm-6 description">
                            <?php echo $email; ?>
                        </div>


                        <div class="col-md-2"></div>
                        <div class="col-md-4 col-sm-6 champProfile">
                            Présentation
                        </div>
                        <div class="col-md-6 col-sm-6 description">
                            <?php echo $presentation; ?>
                        </div>

                        <div class="col-md-2"></div>
                        <div class="col-md-4 col-sm-6 champProfile">
                            Expérience
                        </div>

                        <div class="col-md-6 col-sm-6 description">
                            <?php echo $experience; ?>
                        </div>
                        <div class="col-md-2 col-sm-0"></div>
                        <div class="col-md-10 col-sm-12">
                            <?php
                            $requeteDispo = $bd->prepare('SELECT idD, date, heureD, heureF FROM disponibilite WHERE idN=:idN and date=>:dateDebutSemaine and date=<:dateFinSemaine');
                            $executeDispo = $requeteDispo->execute(array(
                                ':idN' => $id,
                                ':dateDebutSemaine' => $debutSemaine,
                                ':dateFinSemaine' => $finSemaine
                            ));


                            $reqlisteAvisO = $bd->query("SELECT count(idN) NB_RES FROM garde WHERE idN=" . $id . " AND note IS NOT NULL AND date <= CURRENT_DATE() and idE IN (SELECT idE FROM lie)");
                            $listeAvisO = $reqlisteAvisO->fetchAll();
                            if ($listeAvisO[0][0] !== '0') {

                                $reqlisteAvis = $bd->query("SELECT DISTINCT note, appreciation, idE, date FROM garde WHERE idN=" . $id . " AND note IS NOT NULL AND date <= CURRENT_DATE() and idE IN (SELECT idE FROM lie)");
                                $listeAvis = $reqlisteAvis->fetchAll();
//                                var_dump($listeAvis);

                                foreach ($listeAvis as $key => $value) {
                                    $idparent = $bd->query("SELECT DISTINCT idP from lie WHERE idE=" . $value['idE'] . ";");
                                    $idparent = $idparent->fetchAll();
                                    echo "<div class='alert alert-info' role='alert'>";
                                    echo "<h5>Commentaire laissé par la famille " . whichNom4Id($bd, 'parent', $idparent[0][0]) . "</h5><br>";
                                    echo $value['date'] . "<br>";
                                    echo "Note : " . $value['note'] . "<br>";
                                    echo "Appréciation : " . $value['appreciation'] . "<br>";
                                    echo "</div>";
                                }
                            }
                            ?>


                           
                                <?php
                                $reqlisteDispoO = $bd->query("SELECT count(*) NB_RES FROM disponibilite WHERE idN=" . $id . " AND disponible = 1;");
                                $listeDispoO = $reqlisteDispoO->fetchAll();
                                if ($listeDispoO[0][0] !== 0) {
                                    $reqlisteDispo = $bd->query("SELECT date, heureD, heureF FROM disponibilite WHERE idN=" . $id . " AND disponible = 1 ORDER BY date, heureD;");
                                    $listeDispo = $reqlisteDispo->fetchAll();
                                    echo "Je suis disponible :"
                                    . "<ul>";
                                    foreach ($listeDispo as $key => $value) {
                                        echo "<li>";
                                        echo "le " . date("d-m-Y", strtotime($value['date'])) . " de " . $value['heureD'] . " à " . $value['heureF'];

                                        echo "</li>";
                                    }


                                    echo "</ul>";

                                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'nounou') {
                                        echo "<a href='" . SITE_URL . "form_nounou_disponibilite.php' class='btn btn-default' >Compléter vos disponibilités</button>";
                                    }
//                                $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
//                                $rdv["Dimanche"]["16:30"] = "Dermatologue";
//                                $rdv["Lundi"]["9"] = "Mémé -_-";
//                                echo "<thead>";
//                                echo "<tr><th>Heure</th>";
//                                for ($x = 1; $x < 8; $x++)
//                                    echo "<th>" . $jour[$x] . "</th>";
//                                echo "</tr>";
//                                echo "</thead>";
//                                echo "<tbody>";
//                                for ($j = 0; $j < 24; $j += 0.5) {
//                                    echo "<tr>";
//                                    for ($i = 0; $i < 7; $i++) {
//                                        if ($i == 0) {
//                                            $heure = str_replace(".5", ":30", $j);
//                                            echo "<td class = \"time\">" . $heure . "</td>";
//                                        }
//                                        echo "<td>";
//                                        if (isset($rdv[$jour[$i + 1]][$heure])) {
//                                            echo $rdv[$jour[$i + 1]][$heure];
//                                        }
//                                        echo "</td>";
//                                    }
//                                    echo "</tr>";
//                                echo "</tbody>";
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>  

        <section id="vueplanning">

        </section>





        <!-- SCRIPTS -->
        <?php
        script("jquery.js");
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