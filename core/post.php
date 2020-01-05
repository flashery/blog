<?php
require_once('../bootstrap.php');

if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    Post::update();
} elseif(isset($_POST['action']) && $_POST['action'] === 'delete') {
    Post::delete();
}else {
    Post::insert();
}
