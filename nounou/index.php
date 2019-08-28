<?php
session_start();
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



<?php include 'menu.php'; ?>


        <!-- HOME -->
        <section id="home" class="slider" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">

                    <div class="owl-carousel owl-theme">
                        <div class="item item-first">
                            <div class="caption">
                                <div class="col-md-offset-1 col-md-10">
                                    <!--<h3>Let's make your life happier</h3>-->
                                    <h1>Rechercher une nounou</h1>
                                    <!--Rajouter le lien vers la recherche-->
                                    <a href="#team" class="section-btn btn btn-default smoothScroll">Lancer la recherche</a>
                                </div>
                            </div>
                        </div>

                        <div class="item item-second">
                            <div class="caption">
                                <div class="col-md-offset-1 col-md-10">
                                    <!--<h3>Des nounous près de chez</h3>-->
                                    <h1>Des nounous près de chez vous</h1>
                                    <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">Plus d'informations</a>>
                                </div>
                            </div>
                        </div>

                        <div class="item item-third">
                            <div class="caption">
                                <div class="col-md-offset-1 col-md-10">
                                     <!--<<h3>Pellentesque nec libero nisi</h3>-->
                                    <h1>Un service disponible 7j/7</h1>
                                    <a href="inscrire.php" class="section-btn btn btn-default btn-blue smoothScroll">S'inscrire</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- MAKE AN APPOINTMENT -->
        <section id="appointment" data-stellar-background-ratio="3">
            <div class="container">
                <div class="row">



                    <div id='about' class="col-md-12 col-sm-12">
                        <h2 align="left">Plus d'informations</h2> 
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <div class="col-md-12 col-sm-12">
                            <h3 align="center">Qui sommes-nous ?</h3> 
                            <p>
                                Située au cœur de Troyes, l'agence Looking For Nounou est spécialiste de la garde d'enfants à domicile. 
                                Nos nounous régulières ou ponctuelles sont assurées par des professionnelles qualifiées et soigneusement sélectionnées.

                                Vous cherchez une nounou ? Nous sommes là pour vous aider !

                                Sur Looking For Nounou des milliers de personnes proposent leurs services de garde d'enfant.
                            </p>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <h3 align="center">Nos avantages</h3> 
                            <ul>
                                <li>Une recherche personnalisée</li>
                                <li>Une inscription rapide</li>
                                <li>Des nounous préalablement sélectionnées par nos soins</li>
                                <li>Des nounous disponibles dans toute la France</li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>

        </section>




        <!-- SCRIPTS -->
<?php
include 'footer.php';
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
