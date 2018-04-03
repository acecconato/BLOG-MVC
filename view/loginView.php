<?php

    $title = "Connexion";

    if(isset($_SESSION["connected"]) && $_SESSION["connected"] == true) {
        header("Location: /admin");
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Blog personnel d'Anthony Cecconato">
    <meta name="author" content="Anthony Cecconato">

    <title>Anthony Cecconato | <?= htmlspecialchars($title) ?></title>
    <!-- Bootstrap core CSS -->

    <link href="/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/vendor/bootstrap/css/dashboard.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="/public/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="/public/css/freelancer.css" rel="stylesheet">
    <link href="/public/css/custom.css" rel="stylesheet">
</head>

<body>

<section class="fullHeight">
    <div class="container">

        <h2 class="text-center text-uppercase text-secondary mt-4">Connexion</h2>
        <hr class="star-dark">

        <div class="row">
            <div class="col-sm-12 offset-lg-6 col-lg-6 text-center mx-auto text-white">
                <?php
                    if(isset($msg)) {
                        foreach ($msg as $type => $msg) {
                            echo "<p class='bg-".$type."'>".$msg."</p>";
                        }
                    }
                ?>
                <p class="bg-info"><b>Compte de démonstration : demo / demo</b></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="identifier">Pseudo / Email</label>
                                <input type="text" name="identifier"  class="form-control" placeholder="Entrez votre pseudo / email">
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe">
                            </div>
                            <div class="text-center">
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Connexion</button>
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-primary mt-2" href="/"><i class="fas fa-arrow-left"></i> Revenir au site</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap core JavaScript -->
<script src="/public/vendor/jquery/jquery.min.js"></script>
<script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/public/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="/public/js/jqBootstrapValidation.js"></script>
<script src="/public/js/contact_me.js"></script>

<!-- Custom scripts for this template -->
<script src="/public/js/freelancer.min.js"></script>
</body>
</html>
