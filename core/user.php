<?php
require_once('../bootstrap.php');

if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    User::update();
} elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
    // User::delete();
} else {
    User::insert();
}
