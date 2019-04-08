<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Foro</title>
</head>
<body>
    <div id="forum-container">
        <div class="forum-row head">
            <div class="forum-column">   
            Login
            </div>
        </div>
    <div>
        <?php

        if(!empty($params['messages']))
        {
            foreach($params['messages'] as $message)
            {
                echo $message . '</br>';
            }
        }
        ?>
    </div>
    <div id="form-container">
    <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
        <div>
            <div>Usuario</div>
            <div><input type="text" name="username"/></div>
        </div>
        <div>
            <div>Contraseña</div>
            <div><input type="password" name="password"/></div>
        </div>
        <div class="forum-buttons">
            <input class="btn blue" type="submit" name="enviar" value="Iniciar sesión"/>
        </div>
    </div>
    </form>
    </div>
</body>
</html>