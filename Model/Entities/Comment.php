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
            $label,
            $author;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function setComment_id($commentId)
    {
        $this->comment_id = $commentId;
    }

    public function setContent($content)
    {
        $this->content = stripslashes($content);
    }

    public function setCreationDate($date)
    {
        $this->creationDate = $date;
    }

    public function setReason($reason)
    {
        $this->reason = stripslashes($reason);
    }

    public function setPost_id($postId)
    {
        $this->post_id = $postId;
    }

    public function setStatus_id($statusId)
    {
        $this->status_id = $statusId;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function setAuthor($pseudo)
    {
        $this->author = stripslashes($pseudo);
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

    public function getLabel()
    {
        return $this->label;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}