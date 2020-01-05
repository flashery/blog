<?php
require_once('../bootstrap.php');

$password = $_POST['password'];
$email = $_POST['email'];

$db = DB::getInstance();

$user = $db->query("SELECT * FROM users WHERE email = '{$email}'")->first();

if ($user && password_verify($password, $user->password)) {
    $_SESSION['user'] = $user;
    redirector('/index.php');
} else {
    $_SESSION['error'] = 'Username or password is not correct.';
    redirector('/views/login.php');
}
