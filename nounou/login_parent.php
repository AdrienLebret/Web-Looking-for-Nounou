<?php
require_once 'database.php';
require_once 'form.php';
require_once 'css.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <title>Looking for Nounou.com - Nounou : saisissez vos disponibilités</title>
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
        <script src="http://localhost/nounou/health-center-master/js/jquery.js"></script>
        <script src="http://localhost/nounou/health-center-master/js/momentjs.js"></script>
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
        <section id="container-login data-stellar-background-ratio="3">
            <div class="container"align="">
                <div class="row" align="center">

                    <div class="col-md-3"></div>
                    <div class="col-md-6 col-sm-12" align='center'>
                        <form class="form-signin" id="login" method="post" action="connexion.php">
                            <h3>Espace membre parents</h3><br><br>
                            <label for="inputEmail">Email</label> <br>
                            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus><br>

                            <label for="inputPassword">Mot de passe</label>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                        
                                
                                    <input type="hidden" name="role" value="parent">
                            
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>

                        </form>
                    </div>
                    <div class="col-md-3"></div>

                </div>
            </div>
        </section>        


         <?php        include 'footer.php'; ?>

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