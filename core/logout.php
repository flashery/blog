<?php
require_once('../bootstrap.php');
unset($_SESSION['user']);
redirector('/index.php');