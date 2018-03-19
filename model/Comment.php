<?php

namespace Model;

class Comment extends Entity
{

    private $comment_id,
            $content,
            $creationDate,
            $reason = null,
            $author,
            $status;

    const WAITING_FOR_MODERATION = 1;
    const VALIDATED = 2;
    const REFUSED = 3;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function setComment_id($id)
    {
        $id = (int) $id;
        if($id >= 0) {
            $this->comment_id = $id;
        }
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

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setStatus($status)
    {
        $this->status = $status;
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

    public function getAuthor()
    {
        return $this->author;
    }

    public function getStatus()
    {
        return $this->status;
    }
}