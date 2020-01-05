<?php

class Comment
{

    public function insert()
    {
        require_once('../bootstrap.php');

        if (!Auth::check()) redirector('/views/login.php');

        $user = $_SESSION['user'];

        $db = DB::getInstance();

        $post_id = (int) $_POST['post_id'];
        $user_id = (int) $user->id;

        $datas = [
            'content' => $_POST['content'],
            'user_id' => $user_id,
            'post_id' => $post_id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        if ($db->insert('comments', $datas)) {
            redirector('/views/view_post.php?post_id=' . $post_id);
        } else {
            throw new Exception('Sorry, there is some error adding your comment.');
        }
    }

    public static function getComments($post_id)
    {
        $sql = "SELECT `comments`.*, `users`.`first_name` FROM `comments` INNER JOIN `users` ON `users`.id = `comments`.`user_id` WHERE `comments`.`post_id`=?";
        return DB::getInstance()->query($sql, [(int) $post_id])->results();
    }
}
