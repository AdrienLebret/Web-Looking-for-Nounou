<?php
session_start();
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
        <script type="text/javascript">
            function RedirectionJavascript() {
                document.location.href = "http://localhost/nounou";
            }
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
    <body onload="setTimeout('RedirectionJavascript()', 2000)" id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

        <!-- PRE LOADER -->
        <section class="preloader">
            <div class="spinner">

                <span class="spinner-rotate"></span>

            </div>
        </section>


        <?php include 'menu.php'; ?>


        <!-- MAKE AN APPOINTMENT -->
        <section id="container-login data-stellar-background-ratio="3">
            <div class="container">
                <div class="row">
                    <<div class="col-md-12 col-sm-12" align='center'></div>
                    <div class="col-md-12 col-sm-12" align='center'>
                        <?php
                        if (isset($_SESSION['id'])) {
                            $_SESSION = array();

                            (session_destroy());

                            echo "<b>Vous avez bien été déconnecté, vous allez être redirigé vers la page d'accueil.</b>";
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> '
                            . ' <p>Vous êtes déjà déconnecté.</p>'
                                    . '<p>Vous allez être redirigé vers la page d\'accueil. </p></div>. ';
                        }
                        ?>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </section>        


    <?php include 'footer.php'; ?>

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