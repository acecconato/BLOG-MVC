<?php
    /** @var  App\Pagination $pagination */
    /** @var \Model\Entities\Post $post */
    /** @var array $posts */

    $title = "Gestion des articles";
?>

<div class="container-fluid mt-5">
    <div class="row">
        <main role="main" class="col-12 pt-3 px-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mb-3">
                        <a class="btn btn-lg btn-outline-dark mt-3" href="/admin/articles/ajouter">
                            <i class="far fa-plus-square mr-2"></i>
                            Ajouter un article
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Crée le</th>
                            <th>Modifié le</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($posts as $post) {
                        ?>
                        <tr>
                            <td><?= $post->getPostId() ?></td>
                            <td><?= $post->getTitle() ?></td>
                            <td><?= $post->getAuthor() ?></td>
                            <td><?= $post->getCreationDate() ?></td>
                            <td><?= $post->getLastUpdate() ?></td>
                            <td>
                                <a href="/admin/articles/modifier/<?= $post->getPostId() ?>"><i class="far fa-lg fa-edit" title="Modifier"></i></a>
                                <a href="/admin/articles/supprimer/<?= $post->getPostId() ?>"><i class="far fa-lg fa-trash-alt" title="Supprimer"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <nav class="mt-5">
                    <ul class="pagination justify-content-center">

                        <?php
                            if(is_int($pagination->first())) {
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="/admin/articles?page=<?= $pagination->first() ?>"> << </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/admin/articles?page=<?= $pagination->previous() ?>">Précédent</a>
                        </li>
                        <?php
                            }
                        ?>

                        <?php foreach ($navigation as $nb)
                        {
                            ?>
                            <li class="page-item <?= ($pagination->getActualPage() == $nb) ? "disabled" : null ?>">
                                <a class="page-link" href="/admin/articles?page=<?= $nb ?>"><?= $nb ?></a>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                            if (is_int($pagination->next())) {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="/admin/articles?page=<?= $pagination->next() ?>">Suivant</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="/admin/articles?page=<?= $pagination->end() ?>"> >> </a>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </nav>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <a class="btn btn-lg btn-outline-dark mt-3" href="/admin">
                            <i class="fas fa-angle-double-left mr-2"></i>
                            Retour à l'administration
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
