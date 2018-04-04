<?php
    if(empty($_GET['url'])) {
        $scroll = "js-scroll-trigger";
        $index = "";
    } else {
        $scroll = "";
        $index = "/";
    }

    require_once "head.php";
?>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">(╯°□°）╯</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-auto">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded <?= $scroll ?>" href="<?= $index ?>">Accueil</a>
                </li>
                <li class="nav-item mx-auto">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded <?= $scroll ?>" href="<?= $index ?>#about">Présentation</a>
                </li>
                <li class="nav-item mx-auto">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded <?= $scroll ?>" href="<?= $index ?>#skills">Compétences</a>
                </li>
                <li class="nav-item mx-auto">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded <?= $scroll ?>" href="<?= $index ?>#contact">Contact</a>
                </li>
                <li class="nav-item mx-auto">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="/articles">Le blog</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?= $content ?>

<!-- Footer -->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Localisation</h4>
                <p class="lead mb-0">31280 - Drémil Lafage
                    <br>France</p>
            </div>
            <div class="col-md-4 mb-lg-0">
                <h4 class="text-uppercase mb-4">Retrouvez moi sur ...</h4>
                <ul class="list-inline mb-0">

                    <li class="list-inline-item" title="Facebook">
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/anthony.cecconato" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item" title="Twitter">
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/Deediezi" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item" title="Google+">
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://plus.google.com/106535854473464015009" target="_blank">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                    <li class="list-inline-item" title="Linkedin">
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.linkedin.com/in/anthony-cecconato/" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li class="list-inline-item" title="Github">
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://github.com/Deediezi" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 mt-5">
            <?php
                if(isset($_SESSION["userObject"])) {
            ?>
                <a class="btn btn-md btn-outline-light" href="/admin">
                    <i class="fas fa-unlock-alt mr-1"></i>
                    Administration
                </a>
                <a class="btn btn-md btn-outline-light" href="/unset">
                    <i class="fas fa-times-circle mr-1"></i>
                    Déconnexion
                </a>
            <?php
                } else {
            ?>
                <a class="btn btn-md btn-outline-light" href="/connexion">
                    <i class="fas fa-sign-in-alt mr-1"></i>
                    Connexion
                </a>
            <?php } ?>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>


<?php require_once "footer_scripts_loader.php" ?>


</body>

</html>
