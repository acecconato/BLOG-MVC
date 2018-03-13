<?php

namespace Model;

class PostsManager extends PDOFactory
{
    private $_dbh;
    private $_posts = [];

    public function __construct() {
        $this->setDbh();
    }

    private function setDbh() {
        $this->_dbh = PDOFactory::PDOConnect();
    }

    private function hydrate(array $data) {

    }

    public function getPosts() {

    }

    public function getPost($id) {
        if(is_int($id)) {
            if(array_key_exists($id, $this->_posts)) {
                return $this->_posts[$id];
            }
        }
        return false;
    }

    public function addPost(Post $post) {
        // Add a post
    }

    public function updatePost(Post $post) {
        // Update a post
    }
}