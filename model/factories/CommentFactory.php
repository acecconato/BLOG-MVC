<?php

    namespace Model\Factories;

    use Model\Entities\Comment;
    use Model\Entities\Post;
    use Model\Managers\CommentsManager;
    use Model\Managers\Manager;

    class CommentFactory
    {
        public function __construct()
        {
            $this->commentsManager = Manager::getManagerOf("Comments");
            $this->postsManager = Manager::getManagerOf("Posts");
        }

        public static function getValidatedCommentsOfPost(Post $post)
        {
            /** @var CommentsManager $commentsManager */
            $commentsManager = Manager::getManagerOf("Comments");
            $comments = $commentsManager->getValidatedCommentsOfPost($post);

            $validatedComments = [];
            foreach ($comments as $comment) {
                $validatedComments[] = new Comment($comment);
            }

            return $validatedComments;
        }

        public static function addComment($commentToAdd)
        {
            /** @var CommentsManager $commentsManager */
            $commentsManager = Manager::getManagerOf("Comments");
            $comment = new Comment($commentToAdd);

            return $commentsManager->addComment($comment);
        }
    }