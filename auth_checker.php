<?php
//   $_SESSION['loggedin'] = true;
if (!$_SESSION['loggedin']) {
    header("Location: /login.php");
} else {
    header("Location: /");
}
