<?php
        include 'database.php';
        include 'form.php';
        include 'css.php';
?><!DOCTYPE html>
<html lang="en">
<head>

     <title>Looking For Nounou - Inscrivez-vous en tant que nounou</title>
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


     <!-- HEADER -->
     <?php
     include 'header.php';
     ?>


     <?php include 'menu.php'; ?>
     
    

     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <img src="images/appointment-image.jpg" class="img-responsive" alt="">
                    </div>

                    <div class="col-md-12 col-sm-12">
                         <!-- CONTACT FORM HERE -->
                         <form  autocomplete="off" id="appointment-form" role="form" method="post" action="form_nounou_action.php" enctype="multipart/form-data">

                              <!-- SECTION TITLE -->
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 align="center">Postulez en tant que nounou</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-12 col-sm-12">
                                       <?php
                                        input_text("Nom", "nom", "Votre nom"); ?>
                                   </div>
                                        
                                    <div class="col-md-12 col-sm-12">
                                        <?php
                                        input_text("Prénom", 'prenom', "Votre prénom");
                                        ?>
                                   </div>
                                  
                                  <div class="col-md-12 col-sm-12 ui-widget">
                                    <label for="nomV">Ville</label><p></p>
                                    <input id="nomV" type="text" name="nomV" placeholder="Votre ville">
                                </div>
                                  

                                   <div class="col-md-12 col-sm-12">
                                        <label for="date">Date de naissance</label>
                                        <input type="date" name="date" id="date" class="form-control" max='<?php echo date("Y-m-d"); ?>'>
                                   </div>
                                  
                                  <div class="col-md-12 col-sm-12">
                                        <label for="telephone">N° de téléphone portable</label>
                                        <input type="tel" class="form-control" id="phone" name="telephone" placeholder="Téléphone">
                                  </div>
                                  
                                  <div class="col-md-12 col-sm-12">
                                      <label for="email">E-mail</label> <br />
                                          <input type="email" name='email'><br />
                                  </div>
                                  
                                 <div class="col-md-12 col-sm-12">
                                      <label for="password">Mot de passe</label> <br />
                                          <input type="password" name='password'><br />
                                  </div>
                
                                  <div class="col-md-12 col-sm-12">
                                        <label for="presentation">Présentation</label>
                                        <textarea class="form-control" rows="5" id="presentation" name="presentation" placeholder="Présentez-vous en quelques mots."></textarea>
                                   </div>

                                   <div class="col-md-12 col-sm-12">
                                        <label for="experience">Votre expérience</label>
                                        <textarea class="form-control" rows="2" id="experience" name="experience" placeholder="Décrivez briévement votre expérience en tant que nounou."></textarea>
                                   </div>
                                  
                                  <div class="col-md-12 col-sm-12">
                                      <label for="langue">Langues parlées</label> <br />
                                      Cliquez et appuyez sur CTRL pour choisir plusieurs langues. <br/>
                                      <select name="langue[]" id="langue" multiple="multiple" height="300" width="500">
                                      <?php
                                      // On réalise la reqûete permettant de récupérer les langues
                                      $requeteLangue = $bd->query('SELECT langue FROM langue;');
                                      $listeLangue = [];
                                      
                                      // On construit un array en parcourant les réponses retournées.
                                      while ($donnees = $requeteLangue->fetch()) {
                                          $listeLangue[] = $donnees[0];
                                          
                                      }
                                      
                                      // On construit dynamiquement la liste déroulante grâce à l'array créé.
                                                                              select_option($listeLangue);
                                                                              ?>
                                  </select>
                                  </div>
                                  
                                  <div class="col-md-12 col-sm-12">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                        <label for="photo">Votre photo</label> (Elle ne doit pas dépasser 2mo et doit être au format JPGEG, PNG ou GIF.)
                                        <input type="file" id="fichier" name="photo" accept="image/x-png,image/gif,image/jpeg" >
                                   </div>
                                  
                                  
                                        <button type="submit" class="form-control" id="cf-submit">Soumettez votre candidature</button>
                                   </div>
                              </div>
                         </form>
                    </div>

               </div>
          </div>
     </section>


    

     <!-- SCRIPTS -->
     <?php 
     include 'footer.php';
     script("bootstrap.min.js");
     script ("jquery.sticky.js");
     script ("jquery.stellar.min.js");
     script ("wow.min.js");
     script ("smoothscroll.js");
     script ("owl.carousel.min.js");
     script ("custom.js");
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