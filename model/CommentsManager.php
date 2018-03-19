<?php

namespace Model;

class CommentsManager extends Manager
{
    public function getAllComments()
    {
        $query = $this->dbh->prepare("
            SELECT  c.comment_id, c.content, c.creationDate, c.reason, DATE_FORMAT(c.creationDate, '%d/%m/%y à %Hh%i') as creationDate,
                    u.pseudo as author, u.email,
                    s.status_id as status
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

    public function getAllCommentsWithLimit($limit)
    {

    }

    public function getCommentBetween($a, $b)
    {

    }

    public function getCommentById($id)
    {

    }

    public function addComment(Comment $comment)
    {

    }

    public function updateComment(Comment $comment)
    {

    }

    public function deleteComment($id)
    {

    }
}