<?php

    namespace Model\factories;

    use Model\Entities\Post;
    use Model\Managers\Manager;
    use Model\Managers\PostsManager;

    class PostFactory
    {
        public static function getPostById($id)
        {
            /** @var PostsManager $postsManager */
            $postsManager = Manager::getManagerOf("Posts");
            $postData = $postsManager->getPostById($id);

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
            /** @var PostsManager $postsManager */
            $postsManager = Manager::getManagerOf("Posts");
            $allPosts = $postsManager->getAllPosts();

            $posts = [];
            foreach ($allPosts as $post) {
                $posts[] = new Post($post);
            }

            return $posts;
        }
    }