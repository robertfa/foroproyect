<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscador</title>
    </head>
    <body>
    <div id="forum-container">
        <div class="forum-row head">
            <div class="forum-column">   
            Buscador
            </div>
        </div>
        <?php
       
       echo "</br>";
        foreach($params['temas'] as $tema)
        {
         echo '<div>Nom:<a href="./?controller=threads&method=comments&id=' . $tema->temasId . '">'. $tema->titulo.' '. $tema->fecha.' '. $tema->nick.'</a></div>';
         echo "</br>";
        }
        ?>
         </div>
    </body>
</html>
