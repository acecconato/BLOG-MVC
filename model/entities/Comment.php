<?php

namespace Model\Entities;

class Comment extends Entity
{
    private $comment_id,
            $content,
            $creationDate,
            $reason = null,
            $post_id,
            $status_id,
            $author;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function verifyCommentData($data)
    {
        $author = $data["author"];
        $content = $data["content"];
        $post_id = $data["post_id"];

        // Créer un Error manager puis faire les vérifications

        return true;
    }

    public function setComment_id($id)
    {
        $this->comment_id = $id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setCreationDate($date)
    {
        $this->creationDate = $date;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function setPost_id($id)
    {
        $this->post_id = $id;
    }

    public function setStatus_id($id)
    {
        $this->status_id = $id;
    }

    public function setAuthor($pseudo)
    {
        $this->author = $pseudo;
    }

    public function getComment_id()
    {
        return $this->comment_id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getReason()
    {
        return $this->reason;
    }

   public function getPost_id()
   {
       return $this->post_id;
   }

    public function getStatus_id()
    {
        return $this->status_id;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}