<?php
    $title = "Administration";
?>
<div class="container-fluid mt-5">
    <div class="row">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

            <div class="container-fluid">
                <div class="row">

                    <nav class="col-md-2 d-none d-md-block bg-light sidebar mt-5">
                        <div class="sidebar-sticky">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/articles">
                                        <span data-feather="file"></span>
                                        Articles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/commentaires">
                                        <span data-feather="shopping-cart"></span>
                                        Commentaires <span class="badge badge-pill badge-danger"> <?= $nb["comments"]["awaitingModeration"] ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="col-12">
                        <h2>Statistiques du site</h2>
                    </div>

                    <div class="col-12">
                        <p class="lead">
                            <ins>Commentaires :</ins>
                        </p>
                        <p>
                            <b>En attente de modération :</b> <?= $nb["comments"]["awaitingModeration"] ?> <br>
                            <b>Accepté :</b> <?= $nb["comments"]["accepted"] ?>  <br>
                            <b>Refusé :</b> <?= $nb["comments"]["refused"] ?> <br>
                            <b>Total :</b> <?= $nb["comments"]["all"] ?>
                        </p>

                        <p class="lead">
                            <ins>Articles :</ins>
                        </p>
                        <p>
                            <b>Modifié :</b> <?= $nb["posts"]["modified"] ?> <br>
                            <b>Total :</b> <?= $nb["posts"]["all"] ?>
                        </p>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <h2>Que voulez-vous faire ?</h2>
                        </div>
                        <div class="col-lg-12">
                            <a class="btn btn-lg btn-outline-dark mt-3" href="/admin/articles">
                                <i class="fas fa-file-alt mr-2"></i>
                                Gérer les articles
                            </a>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <a class="btn btn-lg btn-outline-dark mt-3" href="/admin/commentaires">
                                <i class="fas fa-comments mr-2"></i>
                                Gérer les commentaires
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>