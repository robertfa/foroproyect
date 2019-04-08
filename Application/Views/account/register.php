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
            Crear cuenta
            </div>
        </div>
        
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
    <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
   
        <div class="fila">
            <div class="text">Nick</div>
            <div class="camp"><input type="text" name="nick"/></div>
        </div>

        <div class="fila">
            <div class="text">Contraseña</div>
            <div class="camp"><input type="password" name="pass1"/></div>
        </div>

        <div class="fila">
            <div class="text">Repita la contraseña</div>
            <div class="camp"><input type="password" name="pass2"/></div>
        </div>

        <div class="fila">
            <div class="text">Email</div>
            <div class="camp"><input type="email" name="correo"/></div>
        </div>

        <div class="fila">
            <div class="text">Avatar</div>
            <div class="camp"><input type="file" name="avatar" id="avatar"/></div>
        </div> 

        <div class="fila">
            <div class="text">Firma</div>
            <div class="camp"><input type="text" name="firma"/></div>
        </div>
   
       <div class="forum-buttons">
            <input class="btn blue" type="submit" name="enviar" value="Crear Cuenta"/>
        </div>
    </div>
    
    </form>
    
    </div>
</body>
</html>

   