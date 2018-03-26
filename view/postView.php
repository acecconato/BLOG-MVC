<?php

/** @var \Model\Entities\Post $post */
$title = $post->getTitle();

ob_start();

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
                        echo "<span class=\"d-block\">Modifié le <b> " . $post->getLastUpdate() . "  </b></span>";
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

        <div class="col-12 media mb-4">
            <img class="mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus
                viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>

        <div class="col-12 media mb-4">
            <img class="mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus
                viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>
    </div>

    <hr>
</div>

<?php

$content = ob_get_clean();

require 'frontend.php';

?>
