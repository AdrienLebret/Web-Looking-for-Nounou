<?php
include 'database.php';
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

                    <div class="col-md-12 col-sm-12">
                        <img src="images/appointment-image.jpg" class="img-responsive" alt="">
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <!-- FORMULAIRE D'INSCRIPTION PARENTS -->
                        <!--<form id="appointment-form" role="form" method="post" action="form_parent_action.php" enctype="multipart/form-data">-->
                        <!--L'action du formulaire s'effectue dans le fichier form_enfant.php-->
                        <form id="appointment-form" role="form" method="post" action="form_enfant.php" enctype="multipart/form-data">
                            <!-- SECTION TITLE -->
                            <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                <h2 align="center">Postulez en tant que parent</h2>
                            </div>

                            <div class="wow fadeInUp" data-wow-delay="0.8s">
                                <div class="col-md-12 col-sm-12">
                                    <?php input_text("Nom de famille", "nomP", "Votre nom"); ?>

                                </div>

                                <div class="col-md-12 col-sm-12 ui-widget">
                                    <label for="nomV">Ville</label><p></p>
                                    <input id="nomV" type="text" name="nomV" placeholder="Votre ville">
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <label for="email">E-mail</label> <br />
                                    <input type="email" name='email'><br />
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label for="password">Mot de passe</label> <br />
                                    <input type="password" name='password'><br />
                                </div>



                                <!--L'idée serait qu'en fonction du nombre sélectionner apparaissent X Champs
                                avec prénom date de naissances / restrictions alimentaires etc....
                              Si l'utilisateur met + : il faudrait qu'une zone de texte apparaissent pour qu'elle écrive son nombre-->
                                <div class="col-md-12 col-sm-12">
                                    <label for="nbEnfants">Nombre d'enfants</label>
                                    <input type="radio" name="nbEnfants" value="1"/> 1
                                    <input type="radio" name="nbEnfants" value="2"/> 2
                                    <input type="radio" name="nbEnfants" value="3"/> 3
                                    <input type="radio" name="nbEnfants" value="4"/> 4
                                    <input type="radio" name="nbEnfants" value="5"/> 5
                                </div>

                                <!--<div class="col-md-12 col-sm-12">
                                    <label for="remarques">Informations générales</label>
                                    <textarea class="form-control" rows="5" id="remarques" name="remarques" placeholder="Si vos enfants ont des contraintes alimentaires, des allergies..."></textarea>
                                </div>-->

                                <button type="submit" class="form-control" id="cf-submit">Envoyer</button>

                            </div>
                        </form>
                    </div>
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
    <script>
        $(function () {
            $("#nomV").autocomplete({
                source: 'rechercheVille.php',
                minLength: 2 // on indique qu'il faut taper au moins 3 caractères pour afficher l'autocomplétion
            });
        });
    </script>
</body>
</html>
