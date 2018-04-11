<?php

    namespace Model\Factories;

    use Model\Entities\Comment;
    use Model\Entities\Post;

    abstract class CommentFactory extends Factory
    {
        public static function getValidatedCommentsOfPost(Post $post)
        {
            /** @var \Model\Managers\CommentsManager $commentsManager */
            $comments = self::getManager("comments")->getValidatedCommentsOfPost($post);

            $validatedComments = [];
            foreach ($comments as $comment) {
                $validatedComments[] = new Comment($comment);
            }

            return $validatedComments;
        }

        public static function getAllComments()
        {
            $allComments = self::getManager("comments")->getAllComments();

            $comments = [];
            foreach ($allComments as $comment) {
                $comments[] = new Comment($comment);
            }

            return $comments;
        }

        public static function getComment($id)
        {
            $commentData = self::getManager("comments")->getCommentById($id);

            if(is_array($commentData)) {
                return new Comment($commentData);
            }

            return header("Location: /admin/commentaires");
        }

        public static function updateComment(Comment $comment)
        {
            try {
                self::getManager("comments")->updateComment($comment);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        public static function deleteComment(Comment $comment)
        {
            $id = $comment->getComment_id();

            try {
                self::getManager("comments")->deleteComment($id);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }