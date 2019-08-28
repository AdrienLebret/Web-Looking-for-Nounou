<?php
include 'func_login.php';
include 'database.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <?php
        if (isset($_POST) && isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            var_dump($_POST);
            if ($_POST['role'] === 'nounou') {

                if (verifyEmail($bd, 'nounou', $email)) {
                    $id = whichId4Mail($bd, 'nounou', $email);
                    if (checkOutBloque($bd, $id)) {

                        echo '<div class="alert alert-danger" role="alert">' .
                        '<p>Votre compte est bloqué, renseignez-vous après de l\'administrateur du site pour plus d\'informations.</p>' .
                        '</div>' . redirectConnexion('', $id);
                    } else if (!checkOutCandidature($bd, $id)) {
                        echo '<div class="alert alert-danger" role="alert">' .
                        '<p>Votre inscription est en attente de validation par l\'administrateur.</p>'
                        . '</div>'
                        . redirectConnexion('', '');
                    } else {
                        connectMail($bd, 'nounou', $email, $password);
                        echo redirectConnexion('nounou', $id);
                        //                var_dump(checkOutBloque($bd, $id));
                        //                var_dump(checkOutCandidature($bd, $id));
                    }
                }
            } else if (($_POST['role'] === 'parent') && (verifyEmail($bd, 'parent', $email))) {
                connectMail($bd, 'parent', $email, $password);
                $id = whichId4Mail($bd, 'parent', $email);
                echo redirectConnexion('parent', $id);
                echo "Vous allez être redirigé vers votre profil.";
            } else {
                echo 'Mot de passe ou identifiant incorrect.';
            }
        }
        ?>
    </body>
</html>