<?php
    $title = "Gestion des commentaires";
?>
<div class="container-fluid mt-5">
    <div class="row">
        <main role="main" class="col-12 pt-3 px-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Auteur</th>
                                <th>Contenu</th>
                                <th>Status</th>
                                <th>Raison (si refusé)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                /** @var \Model\Entities\Comment $comment */
                                foreach ($comments as $comment) {
                            ?>
                            <tr>
                                <td><?= $comment->getComment_id() ?></td>
                                <td><?= $comment->getAuthor() ?></td>
                                <td title="<?= stripslashes($comment->getContent())?>">
                                    <?= (strlen($comment->getContent()) > 50) ? substr_replace(stripslashes($comment->getContent()), " ...", 50) : stripslashes($comment->getContent()) ?>
                                </td>
                                <td><?= $comment->getLabel() ?></td>
                                <td><?= stripslashes($comment->getReason())?></td>
                                <td>
                                <?php
                                    if($comment->getStatus_id() == 1) {
                                ?>
                                    <a href="/admin/commentaires/accepter/<?= $comment->getComment_id() . "?token=" . $_SESSION["token"] ?>"><i class="far fa-lg fa-check-circle " title="Accepter"></i></a>
                                    <a href="/admin/commentaires/refuser/<?= $comment->getComment_id() . "?token=" . $_SESSION["token"] ?>"><i class="far fa-lg fa-times-circle" title="Refuser"></i></a>
                                <?php
                                    }
                                    if($comment->getStatus_id() == 2 || $comment->getStatus_id() == 3) {
                                ?>
                                    <a href="/admin/commentaires/supprimer/<?= $comment->getComment_id() . "?token=" . $_SESSION["token"] ?>"><i class="far fa-lg fa-trash-alt" title="Supprimer"></i></a>
                                <?php
                                    }
                                ?>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <nav class="mt-5">
                    <ul class="pagination justify-content-center">

                        <?php
                        if(is_int($pagination->first())) {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="/admin/commentaires?page=<?= $pagination->first() ?>"> << </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="/admin/commentaires?page=<?= $pagination->previous() ?>">Précédent</a>
                            </li>
                            <?php
                        }
                        ?>

                        <?php foreach ($navigation as $nb)
                        {
                            ?>
                            <li class="page-item <?= ($pagination->getActualPage() == $nb) ? "disabled" : null ?>">
                                <a class="page-link" href="/admin/commentaires?page=<?= $nb ?>"><?= $nb ?></a>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        if (is_int($pagination->next())) {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="/admin/commentaires?page=<?= $pagination->next() ?>">Suivant</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="/admin/commentaires?page=<?= $pagination->end() ?>"> >> </a>
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