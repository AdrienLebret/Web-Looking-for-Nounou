<?php
/*
 * 
 * FORM PARENT ACTION PHP
 * 
 * 
 */
require_once 'func_action.php';
require_once 'func_login.php';
require_once 'database.php';

// On vérifie que l'utilisateur est bien passé par le boutton submit.
if (verifyDefinedName(['nomP', 'nomV', 'email', 'password', 'nbEnfants'])) {

    // On vérifie que l'utilisateur a rempli chaque champ.
    if (verifierChamps()) {
        //var_dump($_POST);
        $nomP = addslashes($_POST['nomP']);

        // Le formulaire transmet le nom de la ville, nous souhaitons de notre côté le 'depcom'
        $nomV = $_POST['nomV'];
        $requete1 = $bd->query("SELECT depcom FROM ville WHERE  nomV = '" . $nomV . "';");
        $depcom = $requete1->fetch();
        $depcom = $depcom[0];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nbEnfants = $_POST['nbEnfants'];
        var_dump($nbEnfants);



        // Après avoir vérifié que l'utilisateur n'est pas déjà inscrit, on l'insère dans notre BDD.
        if (!verifyEmail($bd, $email, 'parent')) {


            $requete2 = "INSERT INTO parent (nomP, emailP, passwordP, depcom) VALUES ('" . $nomP . "', '" . $email . "', '" . $password . "', '" . $depcom . "')";
            $bd->exec($requete2);

            /* echo "<p> \n Felicitation votre inscription est réussie. <br /> \n ";
              if($nbEnfants > 1){
              echo "Il ne vous reste plus qu'à lister vos ". $nbEnfants ." enfants.<br /></p>"; // if nbEnfant = 1 ... sinon mettre au pluriel
              } else { // == 1
              echo "Il ne vous reste plus qu'à lister votre enfant.<br /></p>";
              } */
        } else {
            echo "Vous êtes déjà inscrit";
        }
    }
} else {
    echo "Vous allez être redirigé vers la page d'inscription afin de la compléter.";
}
?>


<?php
/*
 * 
 * FORM ENFANT PHP
 * 
 * 
 */

include 'form.php';
include 'css.php';
include 'header.php';
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

                    <?php
                    for ($nbEnfInscrit = 1; $nbEnfInscrit <= $nbEnfants; $nbEnfInscrit = $nbEnfInscrit + 1) {
                        echo'<div class="col-md-12 col-sm-12">
                        <!-- FORMULAIRE D INSCRIPTION DES ENFANTS -->
                        <form id="appointment-form" role="form" method="post" action="form_enfant_action.php" enctype="multipart/form-data">

                            <!-- SECTION TITLE -->
                            <div class="section-title wow fadeInUp" data-wow-delay="0.4s">';
                        echo '<h2 align="center">Inscription Enfant n°' . $nbEnfInscrit . '</h2>';


                        echo'<div class="wow fadeInUp" data-wow-delay="0.8s">
                                <div class="col-md-0 col-sm-4">

                                    <label for="prenomE" >Prenom</label> <br />
                                    <input id="prenomE" type="text" name="prenomE[]" placeholder="Son Prenom" required>

                                </div>
                                <div class="col-md-4 col-sm-8">
                                    <label for="dateE">Date de naissance</label>
                                    <input type="date" name="dateE[]" id="dateE" class="form-control" required>
                                </div>

                                <div class="col-md-8 col-sm-12">
                                    <label for="restrE">Restriction Alimentaires</label>
                                    <p>Saisir "Non" ou sinon les lister :</p>
                                    <textarea class="form-control" rows="5" id="presentation" name="restrE[]" placeholder="Si votre enfant a des restrictions alimentaires"></textarea>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <label for="infoE">Informations générales</label>
                                    <p>Saisir "Non" ou sinon les lister :</p>
                                    <textarea class="form-control" rows="5" id="infoE[]" name="infoE[]" placeholder="Si vous avez d autres éléments important à déclarer"></textarea>
                                </div>';
                    }
                    // Recheche de l'IDP

                    $requete3 = $bd->query("SELECT idP FROM parent WHERE  emailP = '" . $email . "';");
                    //var_dump($requete1);
                    $idP = $requete3->fetch();
                    //var_dump($depcom);
                    $idP = $idP[0];

                    echo'<input type="hidden" name="idP" value="' . $idP . '"/>';
                    
                    echo'<input type="hidden" name="nbEnfants" value="' . $nbEnfants . '"/>';
                    
                    if($nbEnfants == 1){
                        echo'<button type="submit" class="form-control" id="cf-submit">Inscrire votre enfant</button>';
                    } else {
                        echo'<button type="submit" class="form-control" id="cf-submit">Inscrire vos '.$nbEnfants.' enfants</button>';
                    }
                    

                    echo'</div> </form> </div>';
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
