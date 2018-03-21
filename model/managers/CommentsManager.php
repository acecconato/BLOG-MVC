<?php

namespace Model\Managers;

use Model\Entities\Comment;

class CommentsManager extends Manager
{
    /**
     * @return array
     * Get all comments
     */
    public function getAllComments()
    {
        $query = $this->dbh->prepare("
            SELECT  c.comment_id, c.content, c.creationDate, c.reason, DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    u.user_id, u.pseudo, u.email,
                    p.post_id,
                    s.status_id
            FROM comments c
            LEFT JOIN users u ON c.user_id = u.user_id
            INNER JOIN posts p ON c.post_id = p.post_id
            INNER JOIN status s ON c.status_id = s.status_id
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
            SELECT  c.comment_id, c.content, c.creationDate, c.reason, DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    u.user_id, u.pseudo, u.email,
                    p.post_id,
                    s.status_id
            FROM comments c
            LEFT JOIN users u ON c.user_id = u.user_id
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
            SELECT  c.comment_id, c.content, c.creationDate, c.reason, DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    u.user_id, u.pseudo, u.email,
                    p.post_id,
                    s.status_id
            FROM comments c
            LEFT JOIN users u ON c.user_id = u.user_id
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

    /**
     * @param $id
     * @return array
     * Get a comment by his comment_id
     */
    public function getCommentById($id)
    {
        $query = $this->dbh->prepare("
            SELECT  c.comment_id, c.content, c.creationDate, c.reason, DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    u.user_id, u.pseudo, u.email,
                    p.post_id,
                    s.status_id
            FROM comments c
            LEFT JOIN users u ON c.user_id = u.user_id
            INNER JOIN posts p ON c.post_id = p.post_id
            INNER JOIN status s ON c.status_id = s.status_id
            WHERE c.comment_id = :id
        ");

        $query->bindValue(":id", $id, \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * @param Comment $comment
     * @return int
     */
    public function addComment(Comment $comment)
    {
        $query = $this->dbh->prepare("
            INSERT INTO comments
            (content, user_id, post_id, status_id)
            VALUES
            (:content, :user_id, :post_id, :status_id)
        ");

        $query->bindValue(":content", $comment->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":user_id", $comment->getUser_id(), \PDO::PARAM_INT);
        $query->bindValue(":post_id", $comment->getPost_id(), \PDO::PARAM_INT);
        $query->bindValue(":status_id", $comment->getStatus_id(), \PDO::PARAM_INT);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }

    public function updateComment(Comment $comment)
    {
        $query = $this->dbh->prepare("
            UPDATE comments
            SET content = :content, reason = :reason, status_id = :status_id
        ");

        $query->bindValue(":content", $comment->getContent(), \PDO::PARAM_STR);
        $query->bindValue(":reason", $comment->getReason(), \PDO::PARAM_STR);
        $query->bindValue(":status_id", $comment->getStatus_id(), \PDO::PARAM_INT);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }

    public function deleteComment($id)
    {
        $query = $this->dbh->prepare("
            DELETE FROM comments
            WHERE comment_id = :id
        ");

        $query->bindValue(":id", $id, \PDO::PARAM_INT);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }
}