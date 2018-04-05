<?php
    $title = "Gestion des commentaires";
?>
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
                                <td><?= $comment->getContent() ?></td>
                                <td><?= $comment->getLabel() ?></td>
                                <td><?= $comment->getReason() ?></td>
                                <td>
                                    <a href="#"><i class="far fa-lg fa-check-circle " title="Accepter"></i></a>
                                    <a href="#"><i class="far fa-lg fa-times-circle" title="Refuser"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <nav class="mt-5" aria-label="Page navigation example">
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
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <a class="btn btn-xl btn-outline-dark mt-3" href="/admin">
                            <i class="fas fa-angle-double-left mr-2"></i>
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="refuseModal" tabindex="-1" role="dialog" aria-labelledby="refuseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refuseModalLabel">Refuser un commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Veuillez préciser la raison
                <form action="#" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="reason" aria-describedby="reason" placeholder="Spécifier la raison">
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>