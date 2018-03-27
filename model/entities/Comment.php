<?php

namespace Model\Entities;

class Comment extends Entity
{
    private $comment_id,
            $content,
            $creationDate,
            $reason = null,
            $user_id,
            $post_id,
            $status_id,
            $author;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->getAuthor();
    }

    public function setComment_id($id)
    {
        $id = (int) $id;
        ($id >= 0) ? $this->comment_id = $id : null;
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

    public function setUser_id($id)
    {
        $id = (int) $id;
        ($id >= 0) ? $this->user_id = $id : null;
    }

    public function setPost_id($id)
    {
        $id = (int) $id;
        ($id >= 0) ? $this->post_id = $id : null;
    }

    public function setStatus_id($id)
    {
        $id = (int) $id;
        ($id >= 0) ? $this->status_id = $id : null;
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

   public function getUser_id()
   {
       return $this->user_id;
   }

   public function getPost_id()
   {
       return $this->post_id;
   }

    public function getStatus_id()
    {
        return $this->status_id;
    }
}