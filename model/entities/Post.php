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
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param null $file
     * @return bool
     * @throws \Exception
     */
    public function setPicture($file = null)
    {
        if(!is_null($file)) {
            try {
                $this->picture = PictureHelper::getPostPicture($file);
            } catch (\Exception $e) {
                die("Error: " . $e->getMessage());
            }
        }
        return false;
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