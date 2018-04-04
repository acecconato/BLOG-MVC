<?php

    namespace Model\Factories;

    use Model\Entities\Comment;
    use Model\Entities\Post;
    use Model\Managers\CommentsManager;
    use Model\Managers\Manager;

    class CommentFactory
    {
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
    }