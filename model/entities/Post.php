<?php

namespace Model\Entities;

use App\PictureHelper;

class Post extends Entity
{
    private $post_id,
            $creationDate,
            $title,
            $content,
            $picture,
            $lastUpdate,
            $author;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hasPicture()
    {
        if(is_null($this->picture)) {
            return false;
        }
        return true;
    }

    public function setPost_id($id)
    {
        $this->post_id = $id;
    }

    public function setCreationDate($date)
    {
        $this->creationDate = $date;
    }

    public function setTitle($title)
    {
        $this->title = stripslashes($title);
    }

    public function setContent($content)
    {
        $this->content = stripslashes($content);
    }

    public function setPicture($file = null)
    {
        try {
            $this->picture = PictureHelper::getPostPicture($file);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function setLastUpdate($date)
    {
        $this->lastUpdate = $date;
    }

    public function setAuthor($author)
    {
        $this->author = stripslashes($author);
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
        return substr_replace($this->content, " ...", 150);
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