<?php

class Template
{

    public static function header()
    {
        require_once(__ROOT__ . '/partials/header.php');
    }

    public static function checkAccess()
    {

        if (!Auth::check()) {
            redirector('/views/login.php');
        }
    }

    public static function footer()
    {
        require_once(__ROOT__ . '/partials/footer.php');
    }
}
