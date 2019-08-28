<?php
// Si l'utilisateur n'est pas passé par le formulaire de connexion, on prépare le $_SESSION
if (!isset($_POST['email'])) {
    session_start();
}
require_once 'database.php';
require_once 'func_action.php';
require_once 'func_login.php';
require_once 'form.php';
require_once 'css.php';


// Procédure de connexion:
// On vérifie que l'utilisateur est bien passé par le formulaire de connexion
if (verifyDefinedName(['email', 'password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // On vérifie que l'utilisateur est dans la base de données et on le connecte s'il a saisi le bon mot de passe.
    if (verifyEmail($bd, 'admin', $email)) {
        connectMail($bd, 'admin', $email, $password);
    } else {
        echo 'Mot de passe ou identifiant incorrect.';
    }
}
redirectUnconnected('admin', SITE_URL . "login_admin.php");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <title>Looking for Nounou.com - Page de connexion administrateur</title>
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
        <script src="http://localhost/nounou/js/jquery-last.js"></script>
        <script src="http://localhost/nounou/js/jquery-ui-last.js"></script>
        <!-- Styles propres aux onglets permis par jQuery -->
        <link href="health-center-master/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script>
            $(function () {
                $("#tabs").tabs();
            });
        </script>
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


        <?php include 'menu.php';
        ?>




        <!-- MAKE AN APPOINTMENT -->
        <section id="container-login data-stellar-background-ratio="3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12" align='center'>
                        <?php
// Si l'administrateur est connecté
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] === 'admin') {
                                // ... et qu'il a lancé une demande d'acceptation ou de refus (à travers les liens $_GET on traite sa demande
                                if (isset($_GET['idN'])) {
                                    // S'il s'agit d'une candidature à traiter
                                    if (isset($_GET['decision'])) {
                                        if ($_GET['decision'] === 'accepter') {
                                            $queryAccepter = $bd->query('UPDATE nounou SET accepteN = 1 WHERE idN=' . $_GET['idN'] . ';');
                                        } else if ($_GET['decision'] === 'refuser') {
                                            $queryAccepter = $bd->query('DELETE FROM nounou WHERE idN=' . $_GET['idN'] . ';');
                                        }

                                        // S'il s'agit d'une nounou à bloquer
                                    }
                                    if (isset($_GET['bloquer'])) {
                                        if ($_GET['bloquer'] === 'yes') {
                                            $q = 'UPDATE nounou SET bloqueN = 1 WHERE idN=' . $_GET['idN'] . ';';
                                            $queryBloquer = $bd->query('UPDATE nounou SET bloqueN = 1 WHERE idN=' . $_GET['idN'] . ';');
                                        } else if ($_GET['bloquer'] === 'undo') {
                                            $queryBloquer = $bd->query('UPDATE nounou SET bloqueN = 0 WHERE idN=' . $_GET['idN'] . ';');
                                        }
                                    }
                                }

                                // On récupère ensuite la liste des nounous candidates.
                                $queryRecupCandidature = $bd->query('SELECT idN, photoN, nomN, prenomN, dateN, emailN, experienceN, presentationN FROM nounou WHERE accepteN = 0;');
                                $listeCandidature = $queryRecupCandidature->fetchAll();

                                $queryRecupNounou = $bd->query('SELECT idN, photoN, nomN, prenomN, dateN, emailN, experienceN, presentationN FROM nounou WHERE accepteN = 1 and bloqueN = 0;');
                                $listeNounouActives = $queryRecupNounou->fetchAll();

                                $queryRecupNounouBloques = $bd->query('SELECT idN, photoN, nomN, prenomN, dateN, emailN, experienceN, presentationN FROM nounou WHERE accepteN = 1 and bloqueN = 1;');
                                $listeNounouBloques = $queryRecupNounouBloques->fetchAll();

                                // Produit une ligne de tableau et met en gras le champ si précisé
                                function ligne($contenu, $gras) {
                                    if ($gras) {
                                        echo "<th scope='row'>" . $contenu . "</th>";
                                    } else {
                                        echo "<th>" . $contenu . "</th>";
                                    }
                                }

                                echo "<div id='tabs'>";
                                echo "<ul>
    <li><a href='#tabs-1'>Candidatures en attente de validation</a></li>
    <li><a href='#tabs-2'>Nounous</a></li>
    <li><a href='#tabs-3'>Nounous bloquées</a></li>
    <li><a href='#tabs-4'>Statistiques du site</a></li>
  </ul>";
// On ouvre un tableau dans lequel on va les lister
                                echo "<div id='tabs-1'>
            <table class='table'>
  <thead>
    <tr>
      <th scope='col'>Photo</th>
      <th scope='col'>Email</th>
      <th scope='col'>Nom</th>
      <th scope='col'>Prénom</th>
      <th scope='col'>Date de naissance</th>
      <th scope='col'>Expérience</th>
      <th scope='col'>Présentation</th>
      <th scope='col'>Action</th>
    </tr>
  </thead>
  <tbody>";
// On liste les candidatures en attente d'acceptation.
                                foreach ($listeCandidature as $key => $value) {
                                    echo "<tr>";
                                    $cheminPhoto = "<img src='./avatars/" . $value['photoN'] . "' height='100'>";
                                    ligne($cheminPhoto, false);
                                    ligne($value['emailN'], true);
                                    ligne($value['nomN'], false);
                                    ligne($value['prenomN'], false);
                                    ligne($value['dateN'], false);
                                    ligne($value['experienceN'], false);
                                    ligne($value['presentationN'], false);
                                    $lienAccepter = "<a href='admin.php?idN=" . $value['idN'] . "&decision=accepter'>Accepter</a>";
                                    $lienRefuser = "<a href='admin.php?idN=" . $value['idN'] . "&decision=refuser'>Refuser</a>";
                                    ligne($lienAccepter . " " . $lienRefuser, false);
                                    echo "</tr>";
                                }

                                echo "</tbody>
</table>
        </div>";

                                echo "<div id='tabs-2'>
 <table class='table'>                                   
        <thead>
    <tr>
      <th scope='col'>Photo</th>
      <th scope='col'>Email</th>
      <th scope='col'>Nom</th>
      <th scope='col'>Prénom</th>
      <th scope='col'>Date de naissance</th>
      <th scope='col'>Expérience</th>
      <th scope='col'>Présentation</th>
      <th scope='col'>Action</th>
    </tr>
  </thead>
  <tbody>";
// On liste les nounous actives que l'on voudrait potentiellement bloquer.
                                foreach ($listeNounouActives as $key => $value) {
                                    echo "<tr>";
                                    $cheminPhoto = "<img src='./avatars/" . $value['photoN'] . "' height='100'>";
                                    ligne($cheminPhoto, false);
                                    ligne($value['emailN'], true);
                                    ligne($value['nomN'], false);
                                    ligne($value['prenomN'], false);
                                    ligne($value['dateN'], false);
                                    ligne($value['experienceN'], false);
                                    ligne($value['presentationN'], false);
                                    $lienBloquer = "<a href='admin.php?idN=" . $value['idN'] . "&bloquer=yes'>Bloquer</a>";
                                    ligne($lienBloquer, false);
                                    echo "</tr>";
                                }

                                echo "</tbody>
</table>";
                                echo "</div>";

                                echo "<div id='tabs-3'>
 <table class='table'>                                   
        <thead>
    <tr>
      <th scope='col'>Photo</th>
      <th scope='col'>Email</th>
      <th scope='col'>Nom</th>
      <th scope='col'>Prénom</th>
      <th scope='col'>Date de naissance</th>
      <th scope='col'>Expérience</th>
      <th scope='col'>Présentation</th>
      <th scope='col'>Action</th>
    </tr>
  </thead>
  <tbody>";
// On liste les nounous bloquées.
                                foreach ($listeNounouBloques as $key => $value) {
                                    echo "<tr>";
                                    $cheminPhoto = "<img src='./avatars/" . $value['photoN'] . "' height='100'>";
                                    ligne($cheminPhoto, false);
                                    ligne($value['emailN'], true);
                                    ligne($value['nomN'], false);
                                    ligne($value['prenomN'], false);
                                    ligne($value['dateN'], false);
                                    ligne($value['experienceN'], false);
                                    ligne($value['presentationN'], false);
                                    $lienBloquer = "<a href='admin.php?idN=" . $value['idN'] . "&bloquer=undo'>Débloquer</a>";
                                    ligne($lienBloquer, false);
                                    echo "</tr>";
                                }

                                echo "</tbody>
</table>
</div>";
                                echo "<div id='tabs-4'>";
                                echo "<form method='post' action='admin.php#tabs-4'>";
                                echo"Je souhaite connaître le bénéfice réalisé entre ";
                                echo "le <input type='date' name='dateA'> et le <input type='date' name='dateB'>";
                                echo "<button type ='submit'>Calculer le bénéfice</button>"
                                . "</form>";

                                function profit($bd, $dateA, $dateB) {
                                    $queryresultatMois = $bd->query("SELECT sum(cout) BENEFICE FROM garde WHERE note IS NOT NULL AND date BETWEEN '" . $dateA . "' AND '" . $dateB . "';");
                                    $resultatMois = $queryresultatMois->fetch();
                                    if ($resultatMois[0] != 0 ) {
                                        $res = $resultatMois[0] . "€ ont été récoltés entre le " . $dateA . " et le " . $dateB . ".";
                                    } else {
                                        $res = "Aucun bénéfice n'a été réalisé entre le " . $dateA . " et le " . $dateB . ".";
                                    }

                                    return $res;
                                }

                                if (isset($_POST['dateA']) && isset($_POST['dateB'])) {
                                    echo profit($bd, $_POST['dateA'], $_POST['dateB']);
                                }
                                echo "</div>";
                            }
                        } else {
                            redirectUnconnected('admin', SITE_URL . 'login_admin.php');
                        }
                        ?>
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