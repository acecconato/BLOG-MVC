<?php

namespace Model;

class PostsManager extends PDOFactory
{
    private $dbh;
    private $posts = [];

    public function __construct(array $data = []) {
        $this->_dbh = PDOFactory::PDOConnect();
    }

    private function hydrate(array $data) {
        // Init. 1 instance = 1 post
    }

    public function getPosts() {

    }

    public function getPost($id) {
        // Returns posts by ID
    }

    public function addPost(Post $post) {
        // Add a post
    }

    public function updatePost($post_id, $title, $summary, $content, $picture, $lastUpdate) {
        // Update a post
    }
}