<?php
require_once(dirname(__FILE__) . '/config.php');
require_once(__ROOT__ . '/core/helpers.php');
function autoload($className)
{
    if (file_exists(__ROOT__ . '/' . 'core/' . $className . FILE_EXT)) {

        require_once(__ROOT__ . '/' . 'core/' . $className . FILE_EXT);
    };
}

spl_autoload_register('autoload');
session_start();