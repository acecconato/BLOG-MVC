<?php

/** @var \Model\Entities\Post $post */
/** @var \Model\Entities\Comment $comment */

$title = $post->getTitle();

?>

<!-- Page Content -->
<div class="container pt-5 mt-5">

    <!-- Post section -->
    <div class="row">

        <!-- Post header -->
        <div class="col-12">
            <hr>

            <p>Posté le <b><?= $post->getCreationDate()?></b> par <b><?= $post->getAuthor() ?></b>
                <?php
                    if(!is_null($post->getLastUpdate())) {
                        echo "<span class=\"d-block\">Modifié le <b> " . $post->getLastUpdate() . "</b></span>";
                    }
                ?>
            </p>

            <hr>

            <!-- Post  title -->
            <h2 class="text-center text-uppercase text-secondary mt-4"><?= $post->getTitle() ?></h2>
            <hr class="star-dark mb-5">
        </div>

        <!-- Post image -->
        <div class="col-12 text-center">

            <img class="img-fluid rounded" src="https://wallpapercave.com/wp/dJUICq8.jpg" alt="Image de présentation">

            <hr>
        </div>

        <!-- Post content -->
        <div class="col-12">

            <?= nl2br($post->getContent()) ?>

            <hr>
        </div>
    </div>

    <!-- Comments section -->
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-8 mx-auto text-center">

            <div class="card my-4">
                <h5 class="card-header">Laisser un commentaire</h5>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Comments list -->
    <div class="row">

        <?php
            if(!empty($comments)) {
                foreach ($comments as $k => $comment) {

                }
            }
        ?>

        <div class="col-12 media mb-4">
            <div class="media-body">
                <h5 class="mt-0"><?= $comment->getAuthor() ?></h5>
                <?= $comment->getContent() ?>
            </div>
        </div>

    </div>

    <hr>
</div>
