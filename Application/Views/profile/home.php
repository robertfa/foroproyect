<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="forum-container">
            <div class="forum-row head">
                <div class="forum-column">   
                Perfil
                </div>
            </div>
        <?php
        $posar=$params['tot'];
        
        if(!empty($params['messages']))
        {
            foreach($params['messages'] as $message)
            {
                echo $message . '</br>';
            }
        }
        
        ?>
        <div id="form-container">
         <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">   

        <div class="fila">
            <div class="text">Nueva Contraseña</div>
            <div class="camp"><input type="password" name="pass1"/></div>
        </div>

        <div class="fila">
            <div class="text">Repita la contraseña nueva</div>
            <div class="camp"><input type="password" name="pass2"/></div>
        </div>

        <div class="fila">
            <div class="text">Email</div>
            <div class="camp"><input type="email" name="correo" value=" <?php echo $posar->correo?>"/></div>
        </div>

        <div class="fila">
            <div class="text">Avatar</div>
            <div class="camp"><input type="file" name="avatar" id="avatar" value=" <?php echo $posar->avatar?>" /></div>
        </div> 

        <div class="fila">
            <div class="text">Firma</div>
            <div class="camp"><input type="text" name="firma" value=" <?php echo $posar->firma ?>"/></div>
        </div>

        <div class="fila">
            <div><input class="btn blue" type="submit" name="enviar" value="Cambiar Datos"/></div>
        </div>
    </form>
    </div>
    </div>
    </body>
</html>
