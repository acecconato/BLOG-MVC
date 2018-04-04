<?php

    $title = "Connexion";

    require_once "layout/head.php";
?>

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

<?php require_once "layout/footer_scripts_loader.php" ?>

</body>
</html>
