<?php

class Post
{
    public static function insert()
    {
        if (!Auth::check()) redirector('/views/login.php');

        $user = $_SESSION['user'];

        $db = DB::getInstance();

        $datas = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'user_id' => $user->id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        if ($db->insert('posts', $datas)) {
            redirector('/');
        } else {
            throw new Exception('Sorry, there is some error adding your post.');
        }
    }

    public static function update()
    {
        if (!Auth::check()) redirector('/views/login.php');

        $user = $_SESSION['user'];

        $db = DB::getInstance();

        $id = (int) $_POST['id'];

        $datas = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'user_id' => $user->id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        if ($db->update('posts', $id, $datas)) {
            redirector("/views/post.php?post_id={$id}");
        } else {
            throw new Exception('Sorry, there is some error updating your post.');
        }
    }

    public static function delete()
    {
        if (!Auth::check()) redirector('/views/login.php');

        $db = DB::getInstance();

        $id = (int) $_POST['id'];

        if ($db->delete('posts', $id)) {
            redirector("/");
        } else {
            throw new Exception('Sorry, there is some error deleting your post.');
        }
    }

    public static function getPosts($id = 0)
    {
        if ($id !== 0) {
            $sql = "SELECT `posts`.*, `users`.`first_name` FROM `posts` INNER JOIN `users` ON `users`.`id` = `posts`.`user_id` WHERE `posts`.`id`=?";
            return DB::getInstance()
                ->query($sql, [(int) $id])
                ->first();
        } else {
            $sql = "SELECT `posts`.*, `users`.`first_name` FROM `posts` INNER JOIN `users` ON `users`.id = `posts`.`user_id`";
            return DB::getInstance()->query($sql)->results();
        }
    }
}
