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

    public function getPosts($limit = null) {
        if(isset($limit) && is_int($limit) && $limit >= 0) {
            $query = "SELECT * FROM posts LIMIT " . $limit . "ORDER BY DESC";
        } else {
            $query = "SELECT * FROM posts";
        }

        $query = $this->_dbh->query($query);
        while ($data = $query->fetch()) {
            $this->_posts[$data["post_id"]] = new Post($data);
        }
        $query->closeCursor();

        return $this->_posts;
    }

    public function getPost($id) {
        // Get post by his id
    }

    public function addPost(Post $post) {
        // Add a post
    }

    public function updatePost(Post $post) {
        // Update a post
    }

    public function deletePost($id) {
        // Delete post by Id
    }
}