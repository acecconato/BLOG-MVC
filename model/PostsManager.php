<?php

namespace Model;

class PostsManager extends PDOFactory
{
    /** @var \PDO $_dbh */
    private $_dbh;

    public function __construct()
    {
        $this->setDbh();
    }

    private function setDbh()
    {
        $this->_dbh = PDOFactory::PDOConnect();
    }

    public function getAllPosts()
    {
        $query = $this->_dbh->prepare("SELECT * FROM posts");
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllPostsWithLimit($limit)
    {

    }

    public function getPost($id)
    {
        // Get post by his id
    }

    public function addPost(Post $post)
    {
        // Add a post
    }

    public function updatePost(Post $post)
    {
        // Update a post
    }

    public function deletePost($id)
    {
        // Delete post by Id
    }
}