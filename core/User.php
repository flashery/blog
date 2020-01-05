<?php

class User
{
    public static function insert()
    {
        $db = DB::getInstance();

        if ($_POST['password'] === '') {
            $_SESSION['error'] = 'Password required';
            redirector('/views/registration.php');
        }

        if ($_POST['password'] === $_POST['password2']) {

            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);

            $res = $db->insert('users', [
                'first_name' => $_POST['firstName'],
                'last_name' => $_POST['lastName'],
                'password' => $hash,
                'email' => $_POST['email'],
            ]);

            if ($res) redirector('/views/login.php');
        } else {
            $_SESSION['error'] = 'Password did not match';
            redirector('/views/registration.php');
        }
    }

    public static function update()
    {
        $db = DB::getInstance();

        $id = (int) $_POST['id'];
        $file_name = '';
        if (isset($_FILES['image']) && $_FILES['image']['name'] !== '') $file_name = self::uploadFile();

        if ($_POST['password'] !== '') {
            if ($_POST['password'] === $_POST['password2']) {

                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
                $res = $db->update('users', $id, [
                    'first_name' => $_POST['firstName'],
                    'last_name' => $_POST['lastName'],
                    'password' => $hash,
                    'email' => $_POST['email'],
                    'image' => $file_name,
                ]);
                if ($res) redirector("/views/profile.php?user_id={$id}");
            } else {
                $_SESSION['error'] = 'Password did not match';
                redirector("/views/profile.php?user_id={$id}");
            }
        } else {
            $res = $db->update('users', $id, [
                'first_name' => $_POST['firstName'],
                'last_name' => $_POST['lastName'],
                'email' => $_POST['email'],
                'image' => $file_name,
            ]);

            if ($res) redirector("/views/profile.php?user_id={$id}");
        }
    }

    public static function getUser($id = 0)
    {
        if ($id !== 0) {
            $sql = "SELECT * FROM users WHERE `id`=?";
            return DB::getInstance()
                ->query($sql, [(int) $id])
                ->first();
        }
    }

    private static function uploadFile()
    {
        if (!empty($_FILES['image'])) {
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/profile/";
            $path = $path . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                return basename($_FILES['image']['name']);
            } else {
                $_SESSION['error'] = 'Error uploading files';
                redirector("/views/profile.php?user_id={$_POST['id']}");
            }
        }
    }
}
