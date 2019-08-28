<!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!--Nom du site-->
                    <a href="index.php" class="navbar-brand">Looking For Nounou</a>
                    <!--<a href="index.php" class="navbar-brand"><img src=" health-center-master/images/l4n-image_mini.jpg" /></a>-->
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <!-- <li><a href="#top" class="smoothScroll">Home</a></li>
                         <li><a href="#about" class="smoothScroll">About Us</a></li>
                         <li><a href="#team" class="smoothScroll">Doctors</a></li>
                         <li><a href="#news" class="smoothScroll">News</a></li>
                         <li><a href="#google-map" class="smoothScroll">Contact</a></li>-->
                         <?php 
                         if(isset($_SESSION['id'])) {
                             if($_SESSION['role'] !== 'parent'){
                                 $prenom = $_SESSION['prenom'];
                             }
                             else {
                                 $prenom = '';
                             }
                             
                             echo '<li ><b>' . $prenom .' ' . $_SESSION['nom'] . '</b></li>';
                             echo '<li> (' . $_SESSION['role'] . ')</li>';
                             echo '<li class="appointment-btn deconnexion"><a href="disconnect.php">Se déconnecter</a></li>';
                         
                                 
                         }
                         else {
                             echo '<li class="inscription-btn"><a href="inscrire.php">S\'inscrire</a></li>';                         
                            echo '<li class="appointment-btn"><a href="login.php">Se connecter</a></li>';                         
                         }
                         ?>
                    </ul>
               </div>

          </div>
     </section>