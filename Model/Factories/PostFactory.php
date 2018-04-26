<?php

    namespace Model\Factories;

    use Model\Entities\Post;

    class PostFactory extends Factory
    {
        /**
         * Get a post by its id and returns him as an object.
         * @param $postId
         * @return mixed
         */
        public static function getPost($postId)
        {

            $postData = self::getManager("posts")->getPostById($postId);

            if(is_array($postData)) {
                return new Post($postData);
            }

            return header("Location: /admin/articles");
        }

        /**
         * Retrieves all posts and returns them as an array of objects.
         * @return array
         */
        public static function getAllPosts()
        {
            $allPosts = self::getManager("posts")->getAllPosts();

            $posts = [];
            foreach ($allPosts as $post) {
                $posts[] = new Post($post);
            }

            return $posts;
        }

        /**
         * Delete a post
         * @param Post $comment
         */
        public static function deletePost(Post $comment)
        {
            $postId = $comment->getPostId();

            try {
                self::getManager("posts")->deletePost($postId);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        /**
         * Add a new post and returns the last insert ID.
         * @param Post $post
         * @return bool
         */
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

        /**
         * Create a new post object from a data array.
         * @param array $data
         * @return Post
         */
        public static function createPost(array $data)
        {
            $post = new Post($data);

            /** @var \Model\Entities\User $user */
            $user = unserialize($_SESSION["userObject"]);
            $post->setAuthor($user->getUser_id());

            return $post;
        }

        /**
         * Updates a post and specifying if you want to update the modification date.
         * @param Post $post
         * @param bool $changeUpdateDate
         */
        public static function updatePost(Post $post, $changeUpdateDate = true)
        {
            try {
                self::getManager("posts")->updatePost($post, $changeUpdateDate);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }