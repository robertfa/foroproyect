<?php

define('APP_ROOT', dirname(__FILE__) . '/');
define('APP_PATH', APP_ROOT . 'Application');

require_once APP_PATH . '/Autoload.php';

if(isset($_GET['controller']) && file_exists(APP_PATH.'/Controllers/' . $_GET['controller'] . '.php'))
{
    loadController($_GET['controller']);
}
else
{
      loadController('index');
}