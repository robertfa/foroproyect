<?php

session_start();


function isLoggedIn()
{
    if(isset($_SESSION['user']))
    {
        return true;
    }
}

function requireLoggedIn()
{
    if(!isLoggedIn())
    {
        header('Location: Controllers/login.php');
    }
}

//function getUser($key)
//{
//    if(isLoggedIn())
//    {
//        return $_SESSION['user'][$key];
//    }
//}

function loadView($name,$params=array())
{
    
    include APP_PATH.'/Views/'.$name.'.php';
    
}


function loadModel($name)
{
    include APP_PATH.'/Models/'.$name.'.php';
    
}

function loadController($name)
{
    include APP_PATH.'/Controllers/'.$name.'.php';
    
}

function getAppPath()
{
    return APP_PATH ;
    
}

function getdbc()
{
    include APP_PATH . '/db_login.php';
    return $dbc;
    
}
function getAppRoot()
{
    return APP_ROOT ;
    
}