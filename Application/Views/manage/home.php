<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="forum-container">
            <div class="forum-row head">
                <div class="forum-column">   
                Administrar
                </div>
            </div>


           <table class="grid">
            <thead>
            <tr>
                <th style="width:15%">Nick</th>
                <th style="width:15%">Tipo</th>
                <th style="width:15%">Fecha de registro</th>
                <th style="width:15%">Activo</th>
                <th style="width:15%">Activar/Desactivar</th>
                <th style="width:15%">Promocionar/Despromocionar</th>

            </tr>
            </thead>

            <tbody>
            <?php
           
                foreach($params['usuario'] as $usu)
                { 
                    if($usu->tipo == 0)
                    {
                        $tipo="usuario";

                    }
                    else
                    {
                        $tipo="administrador";

                    }

                    if($usu->activo == 0)
                    {
                        $activo="si";

                    }
                    else
                    {
                        $activo="no";

                    }
                     echo "<tr>";  
                        echo "<td style='width:15%'> $usu->nick </td>";   
                        echo "<td style='width:15%'>  $tipo </td>";
                        echo "<td style='width:15%'> $usu->fechaderegistro </td>";
                        echo "<td style='width:15%'>  $activo </td>";
                        echo "<td style='width:15%'> <a href='./?controller=manage&method=banear&id=$usu->id'>Activar/Desactivar</a></td>";
                        echo "<td style='width:15%'> <a href='./?controller=manage&method=ascender&id=$usu->id'>Promocionar/Despromocionar</a></td>";        
                     echo "</tr>";  
                }

            ?>
            </tbody>

            </table>

 
         </div>
     </body>
</html>
