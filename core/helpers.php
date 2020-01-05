<?php
if (!function_exists('dd')) {
    function dd($datas)
    {
        echo '<pre>';
        var_dump($datas);
        echo '</pre>';
        die();
    }
}
if (!function_exists('redirector')) {
    function redirector($url)
    {
        header('Location: ' . $url);
    }
}
