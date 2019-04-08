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
                Temas
                </div>
            </div>
        
        <div id="category-container">
        <?php
        foreach($params['temas'] as $tema)
        {
          
            if($tema->tipo == 1)
            {
                echo '<div class="forum-row">';
                        echo '<div class="forum-column">';
                            echo "<div class='title'><a href='./?controller=threads&method=commentsLive&id=$tema->temasId'> $tema->titulo                  LIVE</a></div>";
                            echo "<div class='description'>Publicado en $tema->fecha Por $tema->nick </div>";
                        echo '</div>';
		        echo '</div>';
            }
            else
            {
                echo '<div class="forum-row">';
                        echo '<div class="forum-column">';
                            echo "<div class='title'><a href='./?controller=threads&method=comments&id=$tema->temasId'> $tema->titulo</a></div>";
                            echo "<div class='description'>Publicado en $tema->fecha Por $tema->nick </div>";
                        echo '</div>';
		        echo '</div>';


            }

        }
        echo '</div>';
        if(isLoggedIn())
        {
        ?>   
             <div class="forum-buttons">
             <a href="./?controller=threads&method=newThreads&category=<?php echo $_GET['category'];?>" class="btn blue"> nuevo tema </a>
             

       <?php
        }

        if(isLoggedIn())
        {
        ?>   
             
             <a href="./?controller=threads&method=newThreadsLive&category=<?php echo $_GET['category'];?>" class="btn blue"> nuevo tema live </a>
             </div>

       <?php
        }
        ?>
          
    </div> 
    <?php
   // echo $_GET['category'];
     $por_pagina=15;
    $tema= $_GET['category'];

    $total_registros=$params['total'];
        
    $total_paginas=ceil($total_registros/ $por_pagina);
    
        echo '<center> <a href="./?controller=threads&category='.$tema.'&pagina=1"> << </a>';
        
            for($i=1;$i<= $total_paginas;$i++)
            {
                echo '<a href="./?controller=threads&category='.$tema.'&pagina='.$i.'">'. $i.' </a>';


            }
        
        
        echo ' <a href="./?controller=threads&category='.$tema.'&pagina='.$total_paginas.'"> >> </a></center>';
    
    
    ?> 
    </body>
</html>
