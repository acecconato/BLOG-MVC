<?php

    namespace App;

    use Model\Managers\Manager;
    use Model\Managers\PostsManager;

    abstract class PostHelper extends Helper
    {
        /**
         * Count all posts then group them by their status.
         * Used in the admin panel.
         * @return mixed
         */
        public static function countAll()
        {
            /** @var PostsManager $postsManager */
            $postsManager = Manager::getManagerOf("Posts");
            $countPosts = $postsManager->countPosts();

            $count["all"] = 0;
            $count["modified"] = 0;

            foreach ($countPosts as $result) {
                if(!is_null($result["lastUpdate"])) {
                    $count["modified"]++;
                }
                $count["all"]++;
            }

            return $count;
        }
    }