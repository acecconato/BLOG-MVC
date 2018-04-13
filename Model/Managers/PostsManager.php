<?php

namespace Model\Managers;

use Model\Entities\Post;

class PostsManager extends Manager
{

    /**
     * Returns all posts and their latest update date as an array.
     * @return array
     */
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

    /**
     * Returns all posts as an array.
     * @return array
     */
    public function getAllPosts()
    {
        $query = $this->dbh->prepare("
            SELECT  posts.*,
                    DATE_FORMAT(posts.creationDate, '%d/%m/%y à %Hh%i') as creationDate, 
                    DATE_FORMAT(posts.lastUpdate, '%d/%m/%y à %Hh%i') as lastUpdate,
                    u.pseudo as author
            FROM posts
            INNER JOIN users u ON posts.user_id = u.user_id
            ORDER BY post_id DESC
        ");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * Returns a post by its id as an array.
     * @param $id
     * @return mixed
     */
    public function getPostById($id)
    {
        $query = $this->dbh->prepare("
            SELECT posts.*, u.pseudo as author,
            DATE_FORMAT(posts.creationDate, '%d/%m/%y à %Hh%i') as creationDate, 
            DATE_FORMAT(posts.lastUpdate, '%d/%m/%y à %Hh%i') as lastUpdate
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

    /**
     * Try to add a new post in the database and returns the last insert ID.
     * @param Post $post
     * @return string
     * @throws \Exception
     */
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

        try {
            $query->execute();
            return $this->dbh->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception("Impossible d'ajouter l'article dans la base de données");
        }
    }

    /**
     * Try to update a post in the database.
     * @param Post $post
     * @param bool $changeUpdateDate
     * @throws \Exception
     */
    public function updatePost(Post $post, $changeUpdateDate = true)
    {
        $queryToPrepare = "UPDATE posts SET title = :title, content = :content, picture = :picture";
        ($changeUpdateDate == true) ? $queryToPrepare .= ", lastUpdate = NOW()" : null;
        $queryToPrepare .= " WHERE post_id = :post_id";

        $query = $this->dbh->prepare($queryToPrepare);

        $query->bindValue(":title", $post->getTitle(), \PDO::PARAM_STR);
        $query->bindValue(":content", $post->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":picture", $post->getPicture(), \PDO::PARAM_STR);
        $query->bindValue(":post_id", $post->getPostId(), \PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception("Impossible de mettre l'article à jour");
        }
    }

    /**
     * Try to delete a post by its id in the database.
     * @param $id
     * @throws \Exception
     */
    public function deletePost($id)
    {
        $query = $this->dbh->prepare("
            DELETE FROM posts
            WHERE post_id = :id
        ");

        $query->bindValue(":id", $id, \PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception("Impossible de supprimer l'article");
        }
    }
}