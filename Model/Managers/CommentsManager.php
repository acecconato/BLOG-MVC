<?php

namespace Model\Managers;

use Model\Entities\Comment;
use Model\Entities\Post;

class CommentsManager extends Manager
{

    /**
     * Returns all comments and their status as an array.
     * @return array
     */
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
     * Returns all comments with their posts and status as an array.
     * @return array
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
            ORDER BY c.creationDate DESC, c.status_id ASC
        ");

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * Returns all validated comments of a post as an array.
     * @param Post $post
     * @return array
     */
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
     * Returns a comment by its id as an array.
     * @param $commentId
     * @return mixed
     */
    public function getCommentById($commentId)
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

        $query->bindValue(":id", $commentId, \PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    /**
     * Try to add a comment in the database and returns the number of affected lines.
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
     * Try to update a comment in the database.
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
     * Try to delete a comment in the database by its id.
     * @param $commentId
     * @throws \Exception
     */
    public function deleteComment($commentId)
    {
        $query = $this->dbh->prepare("
            DELETE FROM comments
            WHERE comment_id = :id
        ");

        $query->bindValue(":id", $commentId, \PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception("Impossible de supprimer le commentaire");
        }
    }
}