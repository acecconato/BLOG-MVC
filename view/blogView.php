<?php

    /** @var array $posts */
    /** @var \Model\Entities\Post $post */

    $title = "Le blog";
?>

<section class="mt-5" id="posts">

    <div class="container">

        <h2 class="text-center text-uppercase text-secondary mt-4"><?= $title ?></h2>
        <hr class="star-dark mb-5">

        <div class="row">

        <?php
            foreach ($posts as $post) {
        ?>
            <div class="col-sm-12 col-md-4 post my-2 mx-auto">
                <div class="card">
                    <?= ($post->hasPicture()) ? '<img class="card-img-top" src="' . $post->getImageForDisplay() . '" alt="Image de présentation">' : null ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->getTitle() ?></h5>
                        <?= (!is_null($post->getLastUpdate())) ?  "<p><i>Modifié le ".$post->getLastUpdate()."</i></p>" : null ?>
                        <p class="card-text"><?= $post->getSummary() ?></p>
                        <a href="/articles/<?= $post->getPostId() ?>" class="btn btn-primary">Voir l'article</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>

    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Précédent</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Suivant</a>
            </li>
        </ul>
    </nav>
</section>