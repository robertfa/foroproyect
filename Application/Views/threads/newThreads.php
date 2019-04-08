<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categorias - Foro</title>
</head>
<body>
<div id="forum-container">
    <div class="forum-row head">
        <div class="forum-column"> 
            Añadir Temas
        </div>
    </div>

    <div>
        <?php

        if(!empty($messages))
        {
            foreach($messages as $message)
            {
                echo $message . '</br>';
            }
        }
        ?>
    </div>

    <div id="form-container" class="crear">
        <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">

            <div>
                <div>Titulo</div>
                <div><input type="text" name="titulo"/></div>
            <div>

            <div>
                <div>Descripcion</div>
                <div><textarea name="contenido" cols="50" rows="5"></textarea></div>
            <div>
            

            <div class="forum-buttons">
                <input  class="btn blue" type="submit" name="enviar" value="Crear Tema"/>
            </div>
         </div>
        </form>
    </div>
</div>
</body>
</html>
