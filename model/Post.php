<?php

namespace Model;

class Post extends Entity
{
    private $post_id,
            $creationDate,
            $title,
            $summary,
            $content,
            $picture,
            $lastUpdate,
            $author;

    const DEFAULT_PICTURE_PATH = "../TODO";

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function setPost_id($id)
    {
        $id = (int) $id;
        if(is_int($id) && $id >= 0) {
            $this->post_id = $id;
        }
    }

    public function setCreationDate($date)
    {
        if(!empty($date)) {
            $this->creationDate = $date;
        }
    }

    public function setTitle($title)
    {
        if(is_string($title) && !empty($title)) {
            $this->title = $title;
        }
    }

    public function setSummary($summary)
    {
        if(is_string($summary) && !empty($summary)) {
            $this->summary = $summary;
        }
    }

    public function setContent($content)
    {
        if(is_string($content) && !empty($content)) {
            $this->content = $content;
        }
    }

    public function setPicture($path = self::DEFAULT_PICTURE_PATH)
    {
        if(is_string($path)) {
            if(!empty($path)) {
                $this->picture = $path;
                return;
            }
        }
    }

    public function setLastUpdate($date)
    {
        if(!empty($date)) {
            $this->lastUpdate = $date;
        }
    }

    public function setAuthor($author)
    {
        if(!empty($author) && is_string($author)) {
            $this->author = $author;
        }
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getSummary()
    {
        return $this->summary;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}