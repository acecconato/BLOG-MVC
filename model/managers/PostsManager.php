<?php

namespace Model\Managers;

use Model\Entities\Post;

class PostsManager extends Manager
{

    public function countPosts()
    {
        $query = $this->dbh->prepare("
            SELECT post_id, lastUpdate
            FROM posts
        ");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getAllPosts()
    {
        $query = $this->dbh->prepare("
            SELECT  posts.*,
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
            SELECT  posts.*,
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
            SELECT  posts.*,
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
            (title, content, picture, user_id)
            VALUES 
            (:title, :content, :picture, :author)
        ");

        $query->bindValue(":title", $post->getTitle(), \PDO::PARAM_STR);
        $query->bindValue(":content", $post->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":picture", $post->getPicture(), \PDO::PARAM_STR);
        $query->bindValue(":author", $post->getAuthor(), \PDO::PARAM_STR);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }

    public function updatePost(Post $post)
    {
        $query = $this->dbh->prepare("
            UPDATE posts
            SET title = :title, content = :content, picture = :picture, lastUpdate = NOW()
            WHERE post_id = :post_id
        ");

        $query->bindValue(":title", $post->getTitle(), \PDO::PARAM_STR);
        $query->bindValue(":content", $post->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":picture", $post->getPicture(), \PDO::PARAM_STR);
        $query->bindValue(":post_id", $post->getPostId(), \PDO::PARAM_INT);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }

    public function deletePost($id)
    {
        $query = $this->dbh->prepare("
            DELETE FROM posts
            WHERE post_id = :id
        ");

        $query->bindValue(":id", $id, \PDO::PARAM_INT);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }
}