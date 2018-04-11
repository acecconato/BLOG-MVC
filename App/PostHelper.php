<?php

    namespace Appl;

    use Model\Managers\Manager;
    use Model\Managers\PostsManager;

    abstract class PostHelper extends Helper
    {
        public static function countAll()
        {
            /** @var PostsManager $postsManager */
            $postsManager = Manager::getManagerOf("Posts");
            $countPosts = $postsManager->countPosts();

            $nb["all"] = 0;
            $nb["modified"] = 0;

            foreach ($countPosts as $result) {
                if(!is_null($result["lastUpdate"])) {
                    $nb["modified"]++;
                }
                $nb["all"]++;
            }

            return $nb;
        }
    }