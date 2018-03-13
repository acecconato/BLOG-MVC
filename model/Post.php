<?php

namespace Model;

class Posts
{
    private $_postId;
    private $_creationDate;
    private $_title;
    private $_summary;
    private $_content;
    private $_picture;
    private $_lastUpdate;

    public static $nbPosts;

    const DEFAULT_PICTURE_PATH = "../";

    public function setPostId($id) {
        if(is_int($id) && $id >= 0) {
            $this->_postId = $id;
        }
    }

    public function setCreationDate($date) {
        if(!empty($date)) {
            $this->_creationDate = $date;
        }
    }

    public function setTitle($title) {
        if(is_string($title) && !empty($title)) {
            $this->_title = $title;
        }
    }

    public function setSummary($summary) {
        if(is_string($summary) && !empty($summary)) {
            $this->_summary = $summary;
        }
    }

    public function setContent($content) {
        if(is_string($content) && !empty($content)) {
            $this->_content = $content;
        }
    }

    public function setPicture($path = self::DEFAULT_PICTURE_PATH) {
        if(is_string($path)) {
            if(!empty($path)) {
                $this->_picture = $path;
                return;
            }
        }
    }

    public function setLastUpdate($date) {
        if(!empty($date)) {
            $this->_lastUpdate = $date;
        }
    }

    public function getPostId() { return $this->_postId; }
    public function getCreationDate() { return $this->_creationDate; }
    public function getTitle() { return $this->_title; }
    public function getSummary() { return $this->_summary; }
    public function getContent() { return $this->_content; }
    public function getPicture() { return $this->_picture; }
    public function getLastUpdate() { return $this->_lastUpdate; }
}