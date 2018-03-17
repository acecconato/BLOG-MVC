<?php

namespace Model;

class PostsManager extends Manager
{
    public function getAllPosts()
    {
        $query = $this->dbh->prepare("
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

    public function getPostsBetween($a, $b)
    {
        $query = $this->dbh->prepare("
            SELECT  posts.post_id, posts.title, posts.summary, posts.picture,
                    DATE_FORMAT(posts.creationDate, '%d/%m/%y à %Hh%i') as creationDate, 
                    DATE_FORMAT(posts.lastUpdate, '%d/%m/%y à %Hh%i') as lastUpdate,
                    u.pseudo as author
            FROM posts
            INNER JOIN users u ON posts.user_id = u.user_id
            WHERE post_id BETWEEN ':a' AND ':b'
            ORDER BY post_id DESC
        ");

        $query->bindValue(":a", $a, \PDO::PARAM_INT);
        $query->bindValue("b", $b, \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getAllPostsWithLimit($limit)
    {
        $query = $this->dbh->prepare("
            SELECT  posts.post_id, posts.title, posts.summary, posts.picture,
                    DATE_FORMAT(posts.creationDate, '%d/%m/%y à %Hh%i') as creationDate, 
                    DATE_FORMAT(posts.lastUpdate, '%d/%m/%y à %Hh%i') as lastUpdate,
                    u.pseudo as author
            FROM posts
            INNER JOIN users u ON posts.user_id = u.user_id
            ORDER BY post_id DESC
            LIMIT :limit
        ");

        $query->bindValue(":limit", $limit, \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getPostById($id)
    {
        $query = $this->dbh->prepare("
            SELECT posts.*, u.pseudo as author
            FROM posts
            INNER JOIN users u ON posts.user_id = u.user_id
            WHERE post_id = :id
        ");
        $query->bindValue(":id", $id, \PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    public function addPost(Post $post)
    {
        $query = $this->dbh->prepare("
            INSERT INTO posts
            (title, summary, content, picture, user_id)
            VALUES 
            (:title, :summary, :content, :picture, :author)
        ");

        $query->bindValue(":title", $post->getTitle(), \PDO::PARAM_STR);
        $query->bindValue(":summary", $post->getSummary(), \PDO::PARAM_STR);
        $query->bindValue(":content", $post->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":picture", $post->getPicture(), \PDO::PARAM_STR);
        $query->bindValue(":author", $post->getAuthor(), \PDO::PARAM_STR);

        return $result = $query->execute();
    }

    public function updatePost(Post $post)
    {

    }

    public function deletePost($id)
    {
        $query = $this->dbh->prepare("
            DELETE FROM posts
            WHERE post_id = :id
        ");

        $query->bindValue(":id", $id, \PDO::PARAM_INT);

        return $result = $query->execute();
    }
}