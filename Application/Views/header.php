<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ForoPrpyect</title>
    <link rel="stylesheet" type="text/css" href="./static/css/styles.css">
</head>
<body>
    <div id="container">
        <div id="header">
            <div id="forum-profile">
         <?php
            if(isLoggedIn() && $_SESSION['user']['tipo'] >= 1)
            {
            ?>
                <span>Bienvenido, <strong><?= $_SESSION['user']['username'] ?></strong></span>
                <a href="./?controller=account&method=logout">Cerrar sesión</a>
                <a href="./?controller=profile&method=home">perfil</a>
                <a href="./?controller=manage&method=home">administrar</a>

            <?php
            }
            elseif(isLoggedIn())
            {
            ?>
                 <span>Bienvenido, <strong><?= $_SESSION['user']['username'] ?></strong></span>
                <a href="./?controller=account&method=logout">Cerrar sesión</a>
                <a href="./?controller=profile&method=home">perfil</a>

            <?php    
            }
            else
            {
            ?>
                <a href="./?controller=account&method=login">Iniciar sesión</a>
                /
                <a href="./?controller=account&method=register">Registrarse</a>
            <?php    
            }
            ?>
           </div>
            <div class="clearfix"></div>
            <a href="./index.php"><h1>ForoProyect</h1></a>

            <a href="./index.php"><img src="" title="index"/></a>
           
            <form method="post" action="./?controller=search">
               <div><input type="text" name="buscador"/>

                    <input type="submit" name="search" value="search"/></div>
            </form>
   
    </div>