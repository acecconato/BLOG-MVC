<?php

    /** @var array $posts */
    /** @var \Model\Entities\Post $post */

    $title = "Le blog";

    $nbOfLines = ceil((count($posts) / 3));
    $nbPostPerLine = 3;
?>

<section class="mt-5" id="posts">

    <div class="container">

        <h2 class="text-center text-uppercase text-secondary mt-4"><?= $title ?></h2>
        <hr class="star-dark mb-5">


        <?php
            for($i=0; $i <= $nbOfLines; $i++) {
                if($i % $nbPostPerLine = 0) {

                }
            }
        ?>
                   <div class='row lineOfPosts'>

                       <?php
                           foreach ($posts as $post) {
                               ?>
                               <div class="col-sm-12 col-md-4 post my-2 mx-auto">
                                   <div class="card">
                                       <img class="card-img-top"
                                            src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Ftse4.mm.bing.net%2Fth%3Fid%3DOIP.WO7u6MemMh7Gni7DyMo33QHaEK%26pid%3D15.1f=1"
                                            alt="Card image cap">
                                       <div class="card-body">
                                           <h5 class="card-title"><?= $post->getTitle() ?></h5>
                                           <p><i>Modifié le : 10/12/17 à 10h10</i></p>
                                           <p class="card-text"><?= $post->getSummary() ?></p>
                                           <a href="/" class="btn btn-primary">Voir l'article</a>
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