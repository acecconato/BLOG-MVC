<?php

    namespace Model\factories;

    use Model\Entities\Post;

    class PostFactory extends Factory
    {
        public static function getPostById($id)
        {

            $postData = self::getManager("posts")->getPostById($id);

            if(!is_array($postData)) {
                return false;
            }

            $post = new Post($postData);

            if(!is_object($post)) {
                return false;
            }

            return $post;
        }

        public static function getAllPosts()
        {
            $allPosts = self::getManager("posts")->getAllPosts();

            $posts = [];
            foreach ($allPosts as $post) {
                $posts[] = new Post($post);
            }

            return $posts;
        }
    }