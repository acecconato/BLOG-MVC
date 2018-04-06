<?php

namespace Model\Managers;

use Model\Entities\Comment;
use Model\Entities\Post;

class CommentsManager extends Manager
{

    public function countComments()
    {
        $query = $this->dbh->prepare("
            SELECT comment_id, status_id
            FROM comments
        ");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * @return array
     * Get all comments
     */
    public function getAllComments()
    {
        $query = $this->dbh->prepare("
            SELECT  c.*,
            DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    p.post_id,
                    s.status_id, s.label
            FROM comments c
            INNER JOIN posts p ON c.post_id = p.post_id
            INNER JOIN status s ON c.status_id = s.status_id
            ORDER BY comment_id DESC
        ");

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * @param $limit
     * @return array
     * Get $limit latest comments
     */
    public function getLatestCommentsWithLimit($limit)
    {
        $query = $this->dbh->prepare("
            SELECT  c.*,
            DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    p.post_id,
                    s.status_id, s.label
            FROM comments c
            INNER JOIN posts p ON c.post_id = p.post_id
            INNER JOIN status s ON c.status_id = s.status_id
            ORDER BY c.comment_id DESC LIMIT :limit
        ");

        $query->bindValue(":limit", $limit, \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * @param $a
     * @param $b
     * @return array
     * Get all comments between two values (comment_id) sorted from newest to oldest
     */
    public function getLatestCommentBetween($a, $b)
    {
        $query = $this->dbh->prepare("
            SELECT  c.*, 
            DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    p.post_id,
                    s.status_id, s.label
            FROM comments c
            INNER JOIN posts p ON c.post_id = p.post_id
            INNER JOIN status s ON c.status_id = s.status_id
            WHERE c.comment_id BETWEEN :a AND :b
            ORDER BY c.comment_id DESC
        ");

        $query->bindValue(":a", $a, \PDO::PARAM_INT);
        $query->bindValue(":b", $b, \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getValidatedCommentsOfPost(Post $post)
    {
        $query = $this->dbh->prepare("
            SELECT c.*, DATE_FORMAT(c.creationDate, '%d/%m/%y')
            FROM comments c
            INNER JOIN posts p ON p.post_id = c.post_id
            WHERE c.post_id = :post
            AND c.status_id = 2
            ORDER BY c.comment_id DESC
        ");

        $query->bindValue(":post", $post->getPostId(), \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * @param $id
     * @return array
     * Get a comment by his comment_id
     */
    public function getCommentById($id)
    {
        $query = $this->dbh->prepare("
            SELECT  c.*, 
            DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    p.post_id,
                    s.status_id, s.label
            FROM comments c
            INNER JOIN posts p ON c.post_id = p.post_id
            INNER JOIN status s ON c.status_id = s.status_id
            WHERE c.comment_id = :id
        ");

        $query->bindValue(":id", $id, \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    /**
     * @param Comment $comment
     * @return int
     * @throws \Exception
     */
    public function addComment(Comment $comment)
    {
        $query = $this->dbh->prepare("
            INSERT INTO comments
            (content, post_id, author)
            VALUES
            (:content, :post_id, :author)
        ");

        $query->bindValue(":content", $comment->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":post_id", $comment->getPost_id(), \PDO::PARAM_INT);
        $query->bindValue(":author", $comment->getAuthor(), \PDO::PARAM_STR);

        try {
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de l'insertion du commentaire");
        }

        return $affectedLines = $query->rowCount();
    }

    /**
     * @param Comment $comment
     * @throws \Exception
     */
    public function updateComment(Comment $comment)
    {
        $query = $this->dbh->prepare("
            UPDATE comments
            SET content = :content, reason = :reason, status_id = :status_id
            WHERE comment_id = :id
        ");

        $query->bindValue(":content", $comment->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":reason", $comment->getReason(), \PDO::PARAM_STR);
        $query->bindValue(":status_id", $comment->getStatus_id(), \PDO::PARAM_INT);
        $query->bindValue(":id", $comment->getComment_id(), \PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception("Impossible de mettre à jour le commentaire");
        }
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function deleteComment($id)
    {
        $query = $this->dbh->prepare("
            DELETE FROM comments
            WHERE comment_id = :id
        ");

        $query->bindValue(":id", $id, \PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception("Impossible de supprimer le commentaire");
        }
    }
}