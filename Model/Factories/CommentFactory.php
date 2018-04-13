<?php

    namespace Model\Factories;

    use Model\Entities\Comment;
    use Model\Entities\Post;

    abstract class CommentFactory extends Factory
    {
        /**
         * Retrieves validated comments of a post and returns them in an array of objects.
         * @param Post $post
         * @return array
         */
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

        /**
         * Get all comments and returns them in an array of objects.
         * @return array
         */
        public static function getAllComments()
        {
            $allComments = self::getManager("comments")->getAllComments();

            $comments = [];
            foreach ($allComments as $comment) {
                $comments[] = new Comment($comment);
            }

            return $comments;
        }

        /**
         * Get comment by its id and returns it as an object.
         * @param $id
         * @return Comment|void
         */
        public static function getComment($id)
        {
            $commentData = self::getManager("comments")->getCommentById($id);

            if(is_array($commentData)) {
                return new Comment($commentData);
            }

            return header("Location: /admin/commentaires");
        }

        /**
         * Update a comment.
         * @param Comment $comment
         */
        public static function updateComment(Comment $comment)
        {
            try {
                self::getManager("comments")->updateComment($comment);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        /**
         * Delete a comment.
         * @param Comment $comment
         */
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