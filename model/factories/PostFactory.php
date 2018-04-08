<?php

    namespace Model\factories;

    use Model\Entities\Post;

    class PostFactory extends Factory
    {
        public static function getPost($id)
        {

            $postData = self::getManager("posts")->getPostById($id);

            if(is_array($postData)) {
                return new Post($postData);
            }

            return header("Location: /admin/articles");
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

        public static function deletePost(Post $comment)
        {
            $id = $comment->getPostId();

            try {
                self::getManager("posts")->deletePost($id);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        public static function addNewPost(Post $post)
        {
            try {
                $lastInsertId = self::getManager("posts")->addPost($post);
                return $lastInsertId;
            } catch (\Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public static function createPost(array $data)
        {
            $post = new Post($data);

            /** @var \Model\Entities\User $user */
            $user = unserialize($_SESSION["userObject"]);
            $post->setAuthor($user->getUser_id());

            return $post;
        }

        public static function updatePost(Post $post)
        {
            try {
                self::getManager("posts")->updatePost($post, false);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }