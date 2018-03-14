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
        $query = $this->_dbh->prepare("
            SELECT  posts.post_id, posts.title, posts.summary, posts.picture,
                    DATE_FORMAT(posts.creationDate, '%d/%m/%y à %Hh%i') as creationDate, 
                    DATE_FORMAT(posts.lastUpdate, '%d/%m/%y à %Hh%i') as lastUpdate,
                    u.pseudo as author
            FROM posts
            INNER JOIN users u ON posts.user_id = u.user_id
        ");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getAllPostsWithLimit($limit)
    {
        $query = $this->_dbh->prepare("SELECT * FROM posts ORDER BY post_id DESC LIMIT :limit");
        $query->bindValue(":limit", $limit, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getPostById($id)
    {
        $query = $this->_dbh->prepare("SELECT * FROM posts WHERE post_id = :id");
        $query->bindValue(":id", $id, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
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