
 <?php
    $tema=$params['tema'];
    $user=getUser($tema->id_usuario);

    foreach($params['comentaris'] as $comentari)
    {
      
      $avatar=getAvatar($comentari->id_usuario);
      echo '<div class="comments-container clearfix">';
      $user=getUser($comentari->id_usuario);

        echo "<div class='comment'>";
            echo "<div class='contenido'>";
                
                echo "<div>";
                    echo $comentari->fecha;
                echo "</div>";
                
                echo "<div class='mensage'>";
                echo "<div id='mensaje$comentari->id'>".nl2br($comentari->comentario)."</div>"  ;
                echo "</div>";


            echo "<div id='editar$comentari->id'></div>";

            if(isLoggedIn() && $_SESSION['user']['id'] == $comentari->id_usuario)
            {
    
              ?>
           
              <a class="btn small blue" href="" id="editando<?= $comentari->id?>" class="editar" onclick="editar(<?= $comentari->id?>,event)">Editar</a>
 
            <?php
            }
           if(isLoggedIn() && $_SESSION['user']['id'] == $comentari->id_usuario || isLoggedIn() && $_SESSION['user']['tipo'] >= '1')
           {
             ?>
            
             <a  class="btn small blue" href="./?controller=threads&method=eliminarcommentsLive&id=<?= $comentari->id?>&ruta=<?= $tema->id?>"> Eliminar </a>
                     
             <?php
           }

         echo "</div>";
              echo "</div>";
           
           echo '<div class="commentsNick">';
                echo '<div class="commentsAvatar">';
                    echo '<img src="./avatars/'.$avatar.'">';
       
                    echo '<div>Autor:        '.$user->nick.'</div>';  
                echo "</div>";
            echo "</div>";
              echo "<br/>";echo "<br/>";

        echo "</div>";
        
    }
         ?>
