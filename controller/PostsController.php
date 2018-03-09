<?php

namespace Controller;

echo "PostsController.php chargé !";

class PostsController
{
    public function show($id) {
        echo "Je suis l'article $id";
    }
}